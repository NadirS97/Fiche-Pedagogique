import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';



@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) { }

  // pour l'etudiant
  private _isEtudiant:boolean=JSON.parse(localStorage.getItem('EtudiantLogged') || 'false');

  get IsEtudiantLogedIn()
  {
    return JSON.parse(localStorage.getItem('EtudiantLogged') || this._isEtudiant.toString());
  }
  setIsEtudiantLogedIn(value:boolean,numEtu:string){
    this._isEtudiant=value;
    localStorage.setItem('EtudiantLogged', 'true');
    localStorage.setItem('NumEtu',numEtu);
  }

  // for the enseignant
  private _isEnseignant:boolean=JSON.parse(localStorage.getItem('EnseignantLogged') || 'false');
  get IsEnseignantLogedIn()
  {
    return JSON.parse(localStorage.getItem('EnseignantLogged') || this._isEnseignant.toString());
  }
  setIsEnseignantLogedIn(value:boolean){
    this._isEnseignant=value;
    localStorage.setItem('EnseignantLogged', 'true');
  }

  // for the admins
  private _isAdministratif:boolean=JSON.parse(localStorage.getItem('AdministratifLogged') || 'false');;
  get IsAdministratifLogedIn()
  {
    return JSON.parse(localStorage.getItem('EnseignantLogged') || this._isAdministratif.toString());
  }
  setIsAdministratifLogedIn(value:boolean,secr:string){
    this._isAdministratif=value;
    localStorage.setItem('AdministratifLogged', 'true');
    localStorage.setItem('secr',secr);
  }
getUser(data:any){
  return this.http.post<any>('https://localhost:8000/login',data);
}

}
