import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-administratif',
  templateUrl: './administratif.component.html',
  styleUrls: ['./administratif.component.css']
})
export class AdministratifComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }
  _active:boolean=false;
  link1:boolean=true;
  link2:boolean=false;
  link3:boolean=false;
  link4:boolean=false;
  side_bar_menu(){
      this._active=!this._active;
  }
  nav(value:number){
    
    switch (value) {
      case 1:
        this.link1=true;
        this.link2=false;
        this.link3=false;
        this.link4=false; 
        break;
      case 2:
        this.link1=false;
        this.link2=true;
        this.link3=false;
        this.link4=false; 
        break;
      case 3:
        this.link1=false;
        this.link2=false;
        this.link3=true;
        this.link4=false; 
        break;
      case 4:
        this.link1=false;
        this.link2=false;
        this.link3=false;
        this.link4=true; 
        break;
    
      default:
        break;
    }

  }



}
