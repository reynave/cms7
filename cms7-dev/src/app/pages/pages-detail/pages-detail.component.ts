import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { ActivatedRoute } from '@angular/router';

export class Model {
  constructor(
    public name: string,
    public themes: string,
    public url: string
  ) { }
}

@Component({
  selector: 'app-pages-detail',
  templateUrl: './pages-detail.component.html',
  styleUrls: ['./pages-detail.component.css']
})
export class PagesDetailComponent {
  api: string = environment.api;
  id: string = "";

  model = new Model("", "", "");

  constructor(
    private modalService: NgbModal,
    private http: HttpClient,
    private route: ActivatedRoute
  ) {
  }

  onSubmit() { console.log(this.model); }


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
    string = string.replace(/[^\w-]+/g, function(match) {
      var asciiCodes = '';
      for (var i = 0; i < match.length; i++) {
        asciiCodes +=  match.charCodeAt(i) + '-';
      }
      return asciiCodes;
    });

    // return string;
    this.model['url'] = string;
  }

}
