import * as Document from "./Document.js";
import * as _User from "./User.js";

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

export {listDocument,User};

