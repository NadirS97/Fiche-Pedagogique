import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class SansFicheService {

  constructor(private http: HttpClient) { }
  fiches(){
    return this.http.get('https://localhost:8000/secr/fiches/etu/sans');
  }
}
