import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser'; 
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';
import { NotfoundComponent } from './notfound/notfound.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { PagesComponent } from './pages/pages.component';
import { PagesDetailComponent } from './pages/pages-detail/pages-detail.component';
import { WidgetComponent } from './widget/widget.component';
import { WidgetSectionComponent } from './widget/widget-section/widget-section.component';
import { WidgetDetailComponent } from './widget/widget-detail/widget-detail.component';
import { EmbedComponent } from './setting/embed/embed.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,
    NotfoundComponent,
    PagesComponent,
    PagesDetailComponent,
    WidgetComponent,
    WidgetSectionComponent,
    WidgetDetailComponent,
    EmbedComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    NgbModule, 
    FormsModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
