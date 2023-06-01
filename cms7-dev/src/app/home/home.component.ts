import { Component, HostListener, OnInit } from '@angular/core';
import { DomSanitizer, SafeResourceUrl } from '@angular/platform-browser';
import { NgbModalConfig, NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css'],
  providers: [NgbModalConfig, NgbModal],
})
export class HomeComponent implements OnInit { 

  constructor( 
    private modalService: NgbModal, 
  ) {
     
  }

  ngOnInit() {
    
  }

  close(){
    this.modalService.dismissAll();
  }
  
}
