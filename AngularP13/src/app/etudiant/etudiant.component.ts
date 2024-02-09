import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-etudiant',
  templateUrl: './etudiant.component.html',
  styleUrls: ['./etudiant.component.css']
})
export class EtudiantComponent implements OnInit {

  constructor() { }
  _tableau:boolean=true;
  _fiches:boolean=false;
  _new:boolean=false;
  style(content:string,title:any){


    switch (content) {
      case 'Tableau de bord':
        this._tableau=true;
        this._fiches=false;
        this._new=false;
        break;
      case 'Mes fiches pédagogiques':
        this._tableau=false;
        this._fiches=true;
        this._new=false;
        break;
      case 'Fiche pédagogique':
        this._tableau=false;
        this._fiches=false;
        this._new=true;
        break;
    
      default: this._tableau=false;
               this._fiches=false;
               this._new=false;
        break;
    }
    title.innerHTML=content


  }

  ngOnInit(): void {
  }
  _active:boolean=false;
  side_bar_menu(){
      this._active=!this._active;
  }

}
