import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ActivatedRoute } from '@angular/router';
import { ServiceService } from 'src/app/service/service.service';

@Component({
  selector: 'app-embed',
  templateUrl: './embed.component.html',
  styleUrls: ['./embed.component.css']
})
export class EmbedComponent implements OnInit {
  api: string = environment.api;
  value : string = "";
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
    this.http.get<any>(this.api + "setting", {
      headers: this.service.httpHeaders(),
    }).subscribe(
      data => { 
        this.value = atob(data["value"]);
        console.log(data);
      },
      e => {
        console.log(e);
      },
    );
  }
  update(){
    const body = {
      value : btoa(this.value),
      id  : 1,
    }
    this.http.post<any>(this.api + "setting/update", body, {
      headers: this.service.httpHeaders(),
    }).subscribe(
      data => {  
        console.log(data);
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
