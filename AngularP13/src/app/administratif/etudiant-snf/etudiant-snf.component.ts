import { Component, OnInit } from '@angular/core';
import { SansFicheService } from './sans-fiche.service';

@Component({
  selector: 'app-etudiant-snf',
  templateUrl: './etudiant-snf.component.html',
  styleUrls: ['./etudiant-snf.component.css']
})
export class EtudiantSnfComponent implements OnInit {

  constructor(private fiche:SansFicheService) { }

  _etudiants:Array<any>=[]
  _warning:string=""

  ngOnInit(): void {
    this.fiche.fiches().subscribe(
      etudiants=>{
        console.log(etudiants)
        //@ts-ignore
        this._etudiants=etudiants
        this._warning="La liste des etudiants sans fiche pedagogique pour l'année en cours"
      }
    )
  }
  fermer_success(){
    this._warning="";
   }



}
