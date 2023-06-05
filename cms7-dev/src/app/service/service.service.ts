import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ServiceService {

  constructor( ) { }


  httpHeaders(){
    return new HttpHeaders({
      'Content-Type': 'application/json',
      'Token': "123",
    });
  }
}
