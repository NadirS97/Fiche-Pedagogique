import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class FormFicheService {

  constructor(private http: HttpClient) { }

  private _datafiche:Array<any>=[]

  
  Ue(NumEtu:any ){
    return this.http.post('https://localhost:8000/etu/ue',NumEtu);}

    
  Addfiche(data:any ){
    return this.http.post('https://localhost:8000/etu/fiche/new',data);}

   
}
