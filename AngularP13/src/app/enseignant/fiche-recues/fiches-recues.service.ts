import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class FichesRecuesService {

  constructor(private http: HttpClient) { }
  fiches(){
    return this.http.get('https://localhost:8000/ens/fiches_transmises');
  }
  confirmer_fiche(id:number){
    return this.http.get('https://localhost:8000/ens/fiches_confirme/'+id);
  }
  valider_RSE_ue(id:number){
    return this.http.get('https://localhost:8000/ens/fiches_transmises/ue/valider/'+id);
  }
  refuser_RSE_ue(id:number){
    return this.http.get('https://localhost:8000/ens/fiches_transmises/ue/refuser/'+id);
  }
}
