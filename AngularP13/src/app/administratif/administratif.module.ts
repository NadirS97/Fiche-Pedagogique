import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FichesTrtComponent } from './fiches-trt/fiches-trt.component';
import { FichesTrsComponent } from './fiches-trs/fiches-trs.component';
import { EtudiantSnfComponent } from './etudiant-snf/etudiant-snf.component';
import { SecrTableauComponent } from './tableau/tableau.component';
import { SecrProfileComponent } from './profile/profile.component';



@NgModule({
  declarations: [FichesTrtComponent, FichesTrsComponent, EtudiantSnfComponent, SecrTableauComponent, SecrProfileComponent],
  imports: [
    CommonModule
  ]
})
export class AdministratifModule { }
