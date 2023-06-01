import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from 'src/environments/environment';


declare var $: any;
@Component({
  selector: 'app-pages',
  templateUrl: './pages.component.html',
  styleUrls: ['./pages.component.css']
})
export class PagesComponent implements OnInit {
  api: string = environment.api;
  pages: any = [];
  constructor(
    private modalService: NgbModal,
    private http: HttpClient
  ) {
  }

  ngOnInit() {
    this.httpGet();
  }

  httpGet() {

    this.http.get(this.api + "getPages", {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      })
    }).subscribe(
      data => {
        console.log(data);
        this.pages = data;
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
              self.http.post(self.api+"pagesUpdateSorting",order,{
                headers: new HttpHeaders({
                  'Content-Type': 'application/json',
                  'Token': "123",
                })
              }).subscribe(
                data=>{
                  console.log(data);
                },
                e =>{
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

  close() {
    this.modalService.dismissAll();
  }

  fnStatus(status: number, x: any) {
   
    const data = {
      id : x.id,
      status : status,
    }
   
    let objIndex = this.pages.findIndex(((obj: { id: any; }) => obj.id == x.id ));
    this.pages[objIndex]['status'] = status.toString();
    console.log(data,objIndex);
    this.http.post(this.api+"pagesUpdateStatus",data,{
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      })
    }).subscribe(
      data=>{
        console.log(data);
      //  this.httpGet();
      },
      e =>{
        console.log(e);
      }
    )
  }


}
