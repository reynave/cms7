import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ActivatedRoute } from '@angular/router';
import { ServiceService } from 'src/app/service/service.service';

export class Model {
  constructor(
    public h1: string,
    public h2: string,
    public h3: string,
    public h4: string,
    public h5: string,
    public h6: string,
    public img: string,
    public href: string,

  ) { }
}

@Component({
  selector: 'app-widget-detail',
  templateUrl: './widget-detail.component.html',
  styleUrls: ['./widget-detail.component.css']
})
export class WidgetDetailComponent implements OnInit {
  api: string = environment.api;
  id: string = ""; loading: boolean = false;
  model: any = new Model("", "", "", "", "", "", "", "");
  presence : boolean = false;
 
  label: any = {
    h1: false,
    h2: false,
    h3: false,
    h4: false,
    h5: false,
    h6: false,
    img: false,
    href: false,
  }
  getLabel: any = [];
  constructor(
    private modalService: NgbModal,
    private http: HttpClient,
    private route: ActivatedRoute,
    private service: ServiceService,
  ) {
  }

  ngOnInit(): void {
    this.id = this.route.snapshot.params['id'];
    if (this.route.snapshot.queryParams['label']) {
      this.getLabel = this.route.snapshot.queryParams['label'].split(',');
    } else {
      this.getLabel = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'img', 'href'];
    }

    this.getLabel.forEach((el: any) => {
      this.label[el] = true;
    });

    console.log(this.label);

    this.httpGet();

  }

  httpGet() {
    this.http.get<any>(this.api + "widget/detail/" + this.id, {
      headers: this.service.httpHeaders(),
    }).subscribe(
      data => {
        if (data['items']) { 
          this.presence = true;
          this.model.h1 = data['items']['h1'];
          this.model.h2 = data['items']['h2'];
          this.model.h3 = data['items']['h3'];
          this.model.h4 = data['items']['h4'];
          this.model.h5 = data['items']['h5'];
          this.model.h6 = data['items']['h6'];
          this.model.img = data['items']['img'];
          this.model.href = data['items']['href'];
        }
     
      },
      e => {
        console.log(e);
      },
    );
  }
  close() {
    this.modalService.dismissAll();
  }

  back() {
    history.back();
  }

  update() {
    this.loading = true;
    const body = {
      id: this.id,
      model: this.model
    }
    this.http.post<any>(this.api + "widget/update/detail", body, {
      headers: this.service.httpHeaders(),
    }).subscribe(
      data => {
        this.loading = false;
        console.log(data);
      },
      e => {
        console.log(e);
      },
    );
  }


  httpNote: string = "";
  fileName = "";
  onFileSelected(event: any) {
    const file: File = event.target.files[0];
    if (file) {
      this.httpNote = "Upload..";
      console.log(file);
      this.fileName = file.name;
      const formData = new FormData();

      formData.append("userfile", file);
      formData.append("id", this.id);
      formData.append("table", "widget");
      formData.append("token", "123");
      const upload$ = this.http.post(environment.api + "/upload/uploadImages", formData);
      upload$.subscribe(
        data => {
          console.log(data);
          this.httpNote = "";
          this.httpGet();
        },
        e => {
          this.httpNote = "Upload error!";
          console.log(e)
        });
    }
  }

  rmImages() {
    if (confirm("Remove for hosting ?")) {
      this.loading = true;
      const body = {
        id: this.id,
        table: "widget",
      }
      this.http.post<any>(this.api + "upload/removeImages", body, {
        headers: this.service.httpHeaders(),
      }).subscribe(
        data => {
          this.loading = false;
          console.log(data);
          this.model.img = "";
        },
        e => {
          console.log(e);
        },
      );
    }
  }

}
