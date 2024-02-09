import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class FicheATraiterService {

  constructor(private http: HttpClient) { }
  fiches(){
    return this.http.get('https://localhost:8000/secr/fiches');
  }
  valider_fiche(id:any){
    return this.http.post('https://localhost:8000/secr/fiches/valider',id);
  }
  refuser_fiche(id:any){
    return this.http.post('https://localhost:8000/secr/fiches/refuser',id);
  }

}
