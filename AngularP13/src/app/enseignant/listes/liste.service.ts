import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ListeService {

  constructor(private http: HttpClient) { }
  fiches(){
    return this.http.get('https://localhost:8000/ens/fiches_confirme');
  }
}
