import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { NotfoundComponent } from './notfound/notfound.component';
import { LoginComponent } from './login/login.component';
import { PagesComponent } from './pages/pages.component';
import { PagesDetailComponent } from './pages/pages-detail/pages-detail.component';
import { WidgetComponent } from './widget/widget.component';
import { WidgetSectionComponent } from './widget/widget-section/widget-section.component';
import { WidgetDetailComponent } from './widget/widget-detail/widget-detail.component';
import { EmbedComponent } from './setting/embed/embed.component';

const routes: Routes = [
 // { path: "", component: HomeComponent, data: { active: "home" }, },
  { path: "login", component: LoginComponent, data: { active: "home" }, },
  { path: "home", component: HomeComponent, data: { active: "home" }, },

  { path: "pages", component: PagesComponent, data: { active: "pages" }, },
  { path: "pages/:id", component: PagesDetailComponent, data: { active: "pages" }, },
  
  { path: "widget", component: WidgetComponent, data: { active: "widget" }, },
  { path: "widget/:section", component: WidgetSectionComponent, data: { active: "widget" }, },
  { path: "widget/detail/:id", component: WidgetDetailComponent, data: { active: "widget" }, },
  
  { path: "setting/embed", component: EmbedComponent, data: { active: "setting" }, },
  

  { path: "forbiden", component: NotfoundComponent, data: { active: "home" }, },
  { path: "nofound", component: NotfoundComponent, data: { active: "home" }, },
  { path: "**", component: NotfoundComponent, data: { active: "404" } },
];

@NgModule({
  imports: [RouterModule.forRoot(routes,{ useHash:true})],
  exports: [RouterModule]
})
export class AppRoutingModule { }
