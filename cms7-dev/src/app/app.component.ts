import { Component, HostListener, OnInit } from '@angular/core';
import { DomSanitizer, SafeResourceUrl } from '@angular/platform-browser';
import { NgbModalConfig, NgbModal } from '@ng-bootstrap/ng-bootstrap';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html' 
})
export class AppComponent implements OnInit {
@HostListener("window:message", ["$event"])
  parentReceive($event: MessageEvent) {
    console.log($event.data);
  }
  website: string = "http://localhost/website/cms7/public/home/";
  url: any = localStorage.getItem("cms7Url") ? localStorage.getItem("cms7Url") : this.website;

  urlSafe: SafeResourceUrl | undefined;
  urlSafeJson: SafeResourceUrl | undefined;
  urlSafePreview: SafeResourceUrl | undefined;

  constructor(
    public sanitizer: DomSanitizer,
    private modalService: NgbModal,
    config: NgbModalConfig,
  ) {
    config.backdrop = 'static';
    config.keyboard = false;
  }

  ngOnInit() {
    this.urlSafe = this.sanitizer.bypassSecurityTrustResourceUrl(this.url);
    this.urlSafeJson = this.sanitizer.bypassSecurityTrustResourceUrl(this.url + "?data=json");
    this.urlSafePreview = this.sanitizer.bypassSecurityTrustResourceUrl(this.url + "?data=preview");

    if ((localStorage.getItem('cms7Url') === null)) {
      localStorage.setItem("cms7Url", this.website);
    }
  }

  open(content: any, valSize : any = "lg") {
    this.modalService.open(content, { size: valSize });
  }
 
}
