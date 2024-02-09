import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FicheRecuesComponent } from './fiche-recues/fiche-recues.component';
import { EtuSansFicheComponent } from './etu-sans-fiche/etu-sans-fiche.component';
import { ListesComponent } from './listes/listes.component';
import { EnsTableauComponent } from './ens-tableau/ens-tableau.component';



@NgModule({
  declarations: [FicheRecuesComponent, EtuSansFicheComponent, ListesComponent, EnsTableauComponent],
  imports: [
    CommonModule
  ]
})
export class EnseignantModule { }
