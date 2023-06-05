import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ActivatedRoute } from '@angular/router';

export class Model {
  constructor(
    public name: string,
    public themes: string,
    public url: string,
    public idefault: string,
    public img: string,
    public metadata_description: string,
    public metadata_keywords: string,
    public pages_note1: string,
    public pages_note2: string,
    public pages_note3: string,
    public post: string,
    public status: string,
    public title: string,
    public href: string,
    public externalUrl: boolean,

  ) { }
}

@Component({
  selector: 'app-pages-detail',
  templateUrl: './pages-detail.component.html',
  styleUrls: ['./pages-detail.component.css']
})
export class PagesDetailComponent implements OnInit {
  api: string = environment.api;
  id: string = "";
  selectThemes: any = [];
  model: any = [];
  parent: any = {
    id: 0,
    name: "",
  } 
  constructor(
    private modalService: NgbModal,
    private http: HttpClient,
    private route: ActivatedRoute
  ) {
  }
  ngOnInit(): void {
    this.id = this.route.snapshot.params['id'];
    this.httpGet();
  }
  httpGet() {
    console.log(this.route.snapshot.params['id']);
    this.http.get<any>(this.api + "pagesDetail", {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      }),
      params: { id: this.route.snapshot.params['id'] }
    }).subscribe(
      data => {
        console.log(data);
        this.selectThemes = data['themes'];
        this.parent = data['parent'];
        this.model = new Model(
          data.item['name'],
          data.item['themes'],
          data.item['url'],
          data.item['idefault'],
          data.item['img'],
          data.item['metadata_description'],
          data.item['metadata_keywords'],
          data.item['pages_note1'],
          data.item['pages_note2'],
          data.item['pages_note3'],
          data.item['post'],
          data.item['status'],
          data.item['title'],
          data.item['href'],
          data.item['externalUrl'] == "1" ? true : false, 
        )
          ;
      },
      e => {
        console.log(e);
      },
    );
  }

  onSubmit() { 
    console.log(this.model); 
    const body = {
      model : this.model,
      id : this.id
    }
    this.http.post<any>(this.api + "pagesDetailUpdate", body, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Token': "123",
      }),
    }).subscribe(
      data => {
        console.log(data);  
      },
      e => {
        console.log(e);
      },
    );

  }

  updateTitle(){ 
    if(this.model.title == ""){
      this.model.title = this.model.name;
    } 
  }
  close() {
    this.modalService.dismissAll();
  }

  sanitizeString() {
    // Ubah semua spasi menjadi tanda hubung
    var string = this.model['name'].replace(/\s+/g, '-');

    // Ubah menjadi huruf kecil
    string = string.toLowerCase();

    // Hapus karakter khusus
    //string = string.replace(/[^\w-]+/g, '');
    string = string.replace(/[^\w-]+/g, function (match: { length: number; charCodeAt: (arg0: number) => string; }) {
      var asciiCodes = '';
      for (var i = 0; i < match.length; i++) {
        asciiCodes += match.charCodeAt(i) + '-';
      }
      return asciiCodes;
    });

    // return string;
    this.model['url'] = string;
  }

  back(){
    history.back();
  }
  httpNote:string = "";
  fileName = "";
  onFileSelected(event: any) {
    const file: File = event.target.files[0];
    if (file) {
      this.httpNote = "Upload..";
      console.log(file);
      this.fileName = file.name;
      const formData = new FormData();
      
      formData.append("userfile", file);
      formData.append("id",this.id );
      formData.append("table", "pages");  
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


}
