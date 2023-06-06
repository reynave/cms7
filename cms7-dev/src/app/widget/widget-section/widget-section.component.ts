import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ActivatedRoute } from '@angular/router';
import { ServiceService } from 'src/app/service/service.service';

declare var $: any;
@Component({
  selector: 'app-widget-section',
  templateUrl: './widget-section.component.html',
  styleUrls: ['./widget-section.component.css']
})
export class WidgetSectionComponent {
  api: string = environment.api;
  items: any = [];
  section: string = "";
  deleteEnable: boolean = false;

  constructor(
    private modalService: NgbModal,
    private http: HttpClient,
    private route: ActivatedRoute,
    private service: ServiceService,
  ) {
  }

  ngOnInit(): void {
    this.section = this.route.snapshot.params['section'];
    this.httpGet();
  }

  httpGet() {
    this.checkBoxAll = false; 
    this.http.get<any>(this.api + "widget/section/" + this.section, {
      headers: this.service.httpHeaders(),
    }).subscribe(
      data => {
        console.log(data);
        this.items = data['items'];
        var self = this;

        $(function () {
          $(".sortable").sortable({
            handle: ".handle",
            update: function (event: any, ui: any) {
              const order: any[] = [];
              $(".sortable .handle").each((index: number, element: any) => {
                const itemId = $(element).attr("id");
                order.push(itemId);
              });
              console.log(order);
              self.http.post(self.api + "widget/update/sorting", order, {
                headers: self.service.httpHeaders(),
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
  
  addWdiget() {
    const body = {
      section: this.section,
    }
    this.http.post(this.api + "widget/insert", body, {
      headers: this.service.httpHeaders()
    }).subscribe(
      data => {
        console.log(data);
        this.httpGet();
      },
      e => {
        console.log(e);
      }
    );
  }

  deleteWidgetCheck() {
    const body = {
      section: this.section,
      items: this.items,
    }
    console.log(body);
    this.http.post(this.api + "widget/delete", body, {
      headers: this.service.httpHeaders()
    }).subscribe(
      data => {
        console.log(data);
        this.httpGet();
      },
      e => {
        console.log(e);
      }
    );
  }

  checkBoxAll: boolean = false;
  fnCheckboxAll() {
    if (this.checkBoxAll == true) {
      this.items.forEach((el: any) => {
        el['checkbox'] = true;
        this.deleteEnable = true;
      });
    } else {
      this.items.forEach((el: any) => {
        el['checkbox'] = false;
      });
      this.deleteEnable = false;
    }
  
  }
  fnCheckbox() {
    let i = 0;
    this.items.forEach((el: any) => {
      if (el['checkbox'] == true) {
        i++;
      }
    });
    if (i > 0) {
      this.deleteEnable = true;
    } else {
      this.deleteEnable = false;
    }
    
  }


  close() {
    this.modalService.dismissAll();
  }
}
