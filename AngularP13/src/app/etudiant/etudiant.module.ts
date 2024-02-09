import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';

import { BrowserModule } from '@angular/platform-browser';

import { FicheComponent } from './fiche/fiche.component';
import { AddFicheComponent } from './add-fiche/add-fiche.component';
import { ProfileComponent } from './profile/profile.component';
import { ProfileFormComponent } from './profile/form/form.component';
import { EtudiantBoardComponent } from './etudiant-board/etudiant-board.component';
import { FormComponent } from './add-fiche/form/form.component';
import { DataComponent } from './fiche/data/data.component';
import { PasswordComponent } from './profile/form/password/password.component';
import { AppRoutingModule } from '../app-routing.module';


@NgModule({
  declarations: [
    FicheComponent,
    AddFicheComponent,
    ProfileComponent,
    EtudiantBoardComponent,
    FormComponent,
    DataComponent,
    ProfileFormComponent,
    PasswordComponent
  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule
  ]
})
export class EtudiantModule { }
