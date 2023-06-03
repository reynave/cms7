import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ActivatedRoute } from '@angular/router';


declare var $: any;
@Component({
  selector: 'app-pages',
  templateUrl: './pages.component.html',
  styleUrls: ['./pages.component.css']
})
export class PagesComponent implements OnInit {
  api: string = environment.api;
  pages: any = [];
  id : string = "";
  parent_id :  string = "";
  pagesChild: any = [];
  constructor(
    private modalService: NgbModal,
    private http: HttpClient,
    private route: ActivatedRoute
  ) {
  }

  ngOnInit() {
    this.httpGet(this.route.snapshot.queryParams['id']);

  }

  httpGet(id: string) {

    this.http.get<any>(this.api + "getPages", {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      }),
      params: { id: id }
    }).subscribe(
      data => {
        this.id = id;
        console.log(data);
        this.parent_id = data['parent_id'];
        this.pages = data['pages'];
        this.pagesChild = data['pagesChild'];

     //   if(this.parent_id === null) this.parent_id = '0';
        console.log(this.parent_id);
        var self = this;
        $(function () {
          $(".sortable").sortable({
            handle: ".handle",
            update: function (event: any, ui: any) {
              const order: any[] = [];
              $(".sortable li").each((index: number, element: any) => {
                const itemId = $(element).attr("id");
                order.push(itemId);
              });
              console.log(order);
              self.http.post(self.api + "pagesUpdateSorting", order, {
                headers: new HttpHeaders({
                  'Content-Type': 'application/json',
                  'Token': "123",
                })
              }).subscribe(
                data => {
                  console.log(data);
                },
                e => {
                  console.log(e);
                }
              )

            }
          });
        });
      },
      e => {
        console.log(e);
      },
    );
  }

  getChild(id : string) {
    console.log(id);
   
  }
  close() {
    this.modalService.dismissAll();
  }

  fnStatus(status: number, x: any, target : string = "pages") {

    const data = {
      id: x.id,
      status: status,
    }

    if(target == 'pages'){
      let objIndex = this.pages.findIndex(((obj: { id: any; }) => obj.id == x.id));
      this.pages[objIndex]['status'] = status.toString();
      console.log(data, objIndex);
    }
    if(target == 'pagesChild'){
      let objIndex = this.pagesChild.findIndex(((obj: { id: any; }) => obj.id == x.id));
      this.pagesChild[objIndex]['status'] = status.toString();
      console.log(data, objIndex);
    }

   


    this.http.post<any>(this.api + "pagesUpdateStatus", data, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      })
    }).subscribe(
      data => {
        console.log(data);
        //  this.httpGet();
      },
      e => {
        console.log(e);
      }
    )
  }

  pagesSetDefault(id : string){
  
    const data= {
      id :id,
    }
    console.log(data);
    this.http.post<any>(this.api + "pagesSetDefault", data, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      })
    }).subscribe(
      data => { 
        this.httpGet(this.id);
      },
      e => {
        console.log(e);
      }
    )
  }

  pagesInsertChild(){
    const data= {
      id : this.id,
    }
    this.http.post<any>(this.api + "pagesInsertChild", data, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      })
    }).subscribe(
      data => {
       
        this.httpGet(this.id);
      },
      e => {
        console.log(e);
      }
    )
  }

  pagesInsertParent(){
    const data= {
      id : this.id,
    }
    this.http.post<any>(this.api + "pagesInsertParent", data, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      })
    }).subscribe(
      data => {
       
        this.httpGet(this.id);
      },
      e => {
        console.log(e);
      }
    )
  }

  testVPN(){
    let url = "https://systemapk.bsfar.com:41021/test.php";

    this.http.get<any>(url, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      })
    }).subscribe(
      data => {
        console.log(data);
        //  this.httpGet();
      },
      e => {
        console.log(e);
      }
    )
  }
}
