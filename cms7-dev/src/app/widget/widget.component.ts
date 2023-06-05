import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ActivatedRoute } from '@angular/router';
import { ServiceService } from 'src/app/service/service.service';

@Component({
  selector: 'app-widget',
  templateUrl: './widget.component.html',
  styleUrls: ['./widget.component.css']
})
export class WidgetComponent implements OnInit {
  api: string = environment.api;
  items : any = [];
  constructor(
    private modalService: NgbModal,
    private http: HttpClient,
    private route: ActivatedRoute,
    private service: ServiceService,

  ) {
  }

  ngOnInit(): void {
    this.httpGet();
  }
  
  httpGet() {

    this.http.get<any>(this.api + "widget", {
      headers: this.service.httpHeaders(), 
    }).subscribe(
      data => { 
        console.log(data);  
        this.items = data['items'];
      },
      e => {
        console.log(e);
      },
    );
  }
  close() {
    this.modalService.dismissAll();
  }
}
