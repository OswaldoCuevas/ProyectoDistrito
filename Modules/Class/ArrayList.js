import * as Document from "./Document.js";
import * as _User from "./User.js";
import * as _Title from "./Title.js";
import * as _Investment from "./Investment.js";
class listDocument{
    Elements = [];
  
    setArrayElements = (Id_Info,Elements) => {
        this.Elements.push(new Document.Element(Id_Info,Elements));
    }
    getArrayElements () {
         return this.Elements;   
    }
    
    dropTitle(id){
        
        this.Elements = this.Elements.filter(word => word.Id_Info != id);
    }
    searchTitle(id) {
        for(var i=0 ;i<this.Elements.length;i++){
            if(this.Elements[i].Id_Info==id){
                return i+1;
            }
        }
    }
}


class User{
   Users = [];
   setUser(Control_Num,Full_Name,Email,Password_User,RFC,CURP,Type_User,Phone_Number){
    this.Users.push(new _User.user(Control_Num,Full_Name,Email,Password_User,RFC,CURP,Type_User,Phone_Number));
   }
   getUser(){

   }
   getUserSpecific(id){
    for(const User of this.Users){
        if(User.getControl_Num() == id){
            return User;
        }
    }
    return 0;
   }
   alterUser(id,encabezado,info){

   }
   searchUser(id){

   }
   UsersLength(){
    return this.Users.length;
   }
   ShowUsers(){
    for(const User of this.Users){
        return User;
    }
   }
}

class Title{
    Titles = [];
    setTitles(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude){
        this.Titles.push(new _Title.title(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude));     
    }
    getTitleSpecific(id){
        for(const Title of this.Titles){
            if(Title.getTitle_Id() == id){
                return Title;
            }
        }
        return 0;
    }
    showTitles(){
        for(const Title of this.Titles){
           console.log(Title.getTitle_Number());
        }
    }
}
class Investment{
    Investments = [];  
    setInvestment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date){
        this.Investments.push(new _Investment.investment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date));    
    }
    getInvestmentSpecific(id){
        for(const Investment of this.Investments){
            if(Investment.getInvestment_Id() == id){
                return Investment;
            }
        }
        return 0;
    }
    showInvestments(){
        for(const Investment of this.Investments){
           console.log(Investment.getFull_Name());
        }
    }
}

export {listDocument,User,Title,Investment};


