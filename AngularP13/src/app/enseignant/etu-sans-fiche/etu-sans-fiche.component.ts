import { Component, OnInit } from '@angular/core';
import { SansFicheService } from './sans-fiche.service';

@Component({
  selector: 'app-etu-sans-fiche',
  templateUrl: './etu-sans-fiche.component.html',
  styleUrls: ['./etu-sans-fiche.component.css']
})
export class EtuSansFicheComponent implements OnInit {

  constructor(private fiche:SansFicheService) { }

  _etudiants:Array<any>=[]
  _warning:string=""

  ngOnInit(): void {
    this.fiche.fiches().subscribe(
      etudiants=>{
        console.log(etudiants)
        //@ts-ignore
        this._etudiants=etudiants
        this._warning="La liste des etudiants sans fiches pedagogique pour l'année en cours"
      }
    )
  }
  fermer_success(){
    this._warning="";
   }



}
