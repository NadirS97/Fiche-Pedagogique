import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';
import {MatProgressBarModule } from '@angular/material/progress-bar';
import {MatProgressSpinnerModule} from '@angular/material/progress-spinner';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { AuthComponent } from './auth/auth.component';

import { HomeComponent } from './home/home.component';

import { EtudiantModule } from './etudiant/etudiant.module';
import { EtudiantComponent } from './etudiant/etudiant.component';

import {AhthGuard} from './ahth.guard';
import { AuthService } from './auth.service';
import { EnseignantComponent } from './enseignant/enseignant.component';
import { AdministratifComponent } from './administratif/administratif.component';
import { AhthAdmGuard } from './ahth-adm.guard';
import { AhthEnsGuard } from './ahth-ens.guard';
import { LogoutComponent } from './logout/logout.component';
import { AdministratifModule } from './administratif/administratif.module';
import { EnseignantModule } from './enseignant/enseignant.module';


@NgModule({
  declarations: [
    AppComponent,
    AuthComponent,
    HomeComponent,
    EtudiantComponent,
    EnseignantComponent,
    AdministratifComponent,
    LogoutComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    FormsModule,
    HttpClientModule,
    EtudiantModule,
    EnseignantModule,
    MatProgressSpinnerModule,
    AdministratifModule
  ],
  providers: [AuthService,AhthGuard,AhthAdmGuard,AhthEnsGuard],
  bootstrap: [AppComponent]
})
export class AppModule { }
