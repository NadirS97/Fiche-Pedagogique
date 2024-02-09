import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { AuthComponent } from './auth/auth.component';
import {AhthGuard} from './ahth.guard';

import { AddFicheComponent } from './etudiant/add-fiche/add-fiche.component';
import { EtudiantComponent } from './etudiant/etudiant.component';
import { FicheComponent } from './etudiant/fiche/fiche.component';
import { EtudiantBoardComponent } from './etudiant/etudiant-board/etudiant-board.component';

import {HomeComponent} from './home/home.component';
import { AdministratifComponent } from './administratif/administratif.component';
import { AhthAdmGuard } from './ahth-adm.guard';
import { EnseignantComponent } from './enseignant/enseignant.component';
import { AhthEnsGuard } from './ahth-ens.guard';
import { LogoutComponent } from './logout/logout.component';
import { formattedError } from '@angular/compiler';
import { FormComponent } from './etudiant/add-fiche/form/form.component';
import { ProfileComponent } from './etudiant/profile/profile.component';
import { ProfileFormComponent } from './etudiant/profile/form/form.component';
import { PasswordComponent } from './etudiant/profile/form/password/password.component';
import { SecrTableauComponent } from './administratif/tableau/tableau.component';
import { FichesTrtComponent } from './administratif/fiches-trt/fiches-trt.component';
import { FichesTrsComponent } from './administratif/fiches-trs/fiches-trs.component';
import { SecrProfileComponent } from './administratif/profile/profile.component';
import { EtudiantSnfComponent } from './administratif/etudiant-snf/etudiant-snf.component';
import { EnsTableauComponent } from './enseignant/ens-tableau/ens-tableau.component';
import { EtuSansFicheComponent } from './enseignant/etu-sans-fiche/etu-sans-fiche.component';
import { FicheRecuesComponent } from './enseignant/fiche-recues/fiche-recues.component';
import { ListesComponent } from './enseignant/listes/listes.component';


const routes: Routes = [
  {path:'home', component: HomeComponent},
  {path:'login', component: AuthComponent},
  {path:'logout', component:LogoutComponent},
  {
    path:'Adm',
    component: AdministratifComponent,
    canActivate: [AhthAdmGuard],
    children:[

      {path:'',component: SecrTableauComponent},
      {path:'ft',component:FichesTrtComponent},
      {path:'fts',component:FichesTrsComponent},
      {path:'etu',component:EtudiantSnfComponent},
      {path:'profile',component:SecrProfileComponent}
    ]
    

  },
  {
    path:'Ens',
    component: EnseignantComponent,
    canActivate: [AhthEnsGuard],
    children:[

      {path:'',component:EnsTableauComponent},
      {path:'fr',component:FicheRecuesComponent},
      {path:'etu',component:EtuSansFicheComponent},
      {path:'list',component:ListesComponent}
      
    ]
  },
  {
    path:'Etu',
    component: EtudiantComponent,
    canActivate: [AhthGuard],
    children:[
      {path:'', component:EtudiantBoardComponent},
      {path:'fiche', component:FicheComponent},
      {
        path:'ajouter',
       component:AddFicheComponent,
       children:[
         {path:'',component:FormComponent}
       ]
     },
      {
        path:'profile',
       component:ProfileComponent,
       children:[
         {
           path:'',component:ProfileFormComponent,
           children:[
             {
               path:'password',component:PasswordComponent
               
              }, {
                path:'**', redirectTo:'',pathMatch: 'full'
              }
           ]

          }
       ]
     }
    ]

  },
  {
    path:'', component:HomeComponent
  },
  {
    path:'**', redirectTo:'/',pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
