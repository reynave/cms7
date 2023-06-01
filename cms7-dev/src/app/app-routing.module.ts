import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { NotfoundComponent } from './notfound/notfound.component';
import { LoginComponent } from './login/login.component';
import { PagesComponent } from './pages/pages.component';
import { PagesDetailComponent } from './pages/pages-detail/pages-detail.component';

const routes: Routes = [
 // { path: "", component: HomeComponent, data: { active: "home" }, },
  { path: "login", component: LoginComponent, data: { active: "home" }, },
  { path: "home", component: HomeComponent, data: { active: "home" }, },
  { path: "pages", component: PagesComponent, data: { active: "pages" }, },
  { path: "pages/:id", component: PagesDetailComponent, data: { active: "pages" }, },
  
  { path: "forbiden", component: NotfoundComponent, data: { active: "home" }, },
  { path: "nofound", component: NotfoundComponent, data: { active: "home" }, },
  { path: "**", component: NotfoundComponent, data: { active: "404" } },
];

@NgModule({
  imports: [RouterModule.forRoot(routes,{ useHash:true})],
  exports: [RouterModule]
})
export class AppRoutingModule { }
