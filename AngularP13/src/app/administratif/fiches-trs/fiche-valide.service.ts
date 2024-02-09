import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class FicheValideService {

  constructor(private http: HttpClient) { }
  fiches(id:number){
    return this.http.get('https://localhost:8000/secr/fiches_valide/'+id);
  }
  transmettre(id:number){
    return this.http.get('https://localhost:8000/secr/fiches_transmetre/'+id);
  }
  transmettre_tous(id:number){
    return this.http.get('https://localhost:8000/secr/fiches_tout_transmettre/'+id);
  }
}
