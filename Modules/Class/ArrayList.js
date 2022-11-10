import * as Document from "./Document.js";
import * as _User from "./User.js";
import * as _Title from "./Title.js";
import * as _Investment from "./Investment.js";
import * as _TransferTitle from "./TransferTitle.js";
import * as _TransferWater from "./TransferWater.js";
import * as _Location from "./Location.js";
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
   vacio(){
        this.Users = [];
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
    vacio(){
        this.Titles = [];
    }
}
class Investment{
    Investments = [];  
    setInvestment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date){
        this.Investments.push(new _Investment.investment(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date));    
    }
    getInvestmentSpecific(id){
        for(const Investment of this.Investments){
            if(Investment.getInvestments_Id() == id){
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
    vacio(){
        this.Investments = [];
    }
}
class TransferTitle{
    TransferTitles = [];
    setTransferTitle(Transfer_Date,Title_Id,Transfers_Id,namePrevious,nameNew,idPrevious,idNew,Title_Number,Actual ){
    this.TransferTitles.push(new _TransferTitle.transferTitle(Transfer_Date,Title_Id,Transfers_Id,namePrevious,nameNew,idPrevious,idNew,Title_Number,Actual ) )
    }
    getTransferTitle(id){
        for(const TransferTitle of this.TransferTitles){
            if(TransferTitle.getTransfers_Id() == id){
                return TransferTitle;
            }
        }
        return 0;
    }
    showTransferTitles(){
        for(const TransferTitle of this.TransferTitles){
           console.log(TransferTitle.getnameNew());
        }
    }
} 
class TransferWater{
    TransferWaters = [];

    setTransferWater(Transfers_Id,Date_Start,Date_End,Amount,SetTitleNumber,GetTitleNumber,SetTitleId,GetTitleId,SetName,GetName,SetControl_Num,GetControl_Num){
    this.TransferWaters.push(new _TransferWater.transferWater(Transfers_Id,Date_Start,Date_End,Amount,SetTitleNumber,GetTitleNumber,SetTitleId,GetTitleId,SetName,GetName,SetControl_Num,GetControl_Num));
   
   } 
   getTransferWater(id){
    for(const TransferWater of this.TransferWaters){
        if(TransferWater.getTransfers_Id() == id){
            return TransferWater;
        }
    }
    return 0;
}
showTransferWaters(){
    for(const TransferWater of this.TransferWaters){
       console.log(TransferWater.getTransfers_Id());
    }
}
}
class Location{
    Locations = [];

    setLocation(Change_Id,Title_Id,Change_Date,Plot1,Cologne1,Longitude1,Latitude1,Plot2,Cologne2,Longitude2,Latitude2){
    this.Locations.push(new _Location.location(Change_Id,Title_Id,Change_Date,Plot1,Cologne1,Longitude1,Latitude1,Plot2,Cologne2,Longitude2,Latitude2));
   
   } 
   getLocation(id){
    for(const Location of this.Locations){
        if(Location.getChange_Id() == id){
            return Location;
        }
    }
    return 0;
}
showLocations(){
    for(const Location of this.Locations){
       console.log(Location.getChange_Id());
    }
}
}



export {listDocument,User,Title,Investment,TransferTitle,TransferWater,Location};


