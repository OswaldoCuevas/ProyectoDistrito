class TypeTitle{
    Id_Info;
    Title_Number;
    constructor(Id_Info,Title_Number){
        this.setId_Info(Id_Info);
        this.setTitle_Number(Title_Number);
    }
    getId_Info(){
        return this.Id_Info;
    }
    setId_Info(Id_Info){
        this.Id_Info = Id_Info;
    }
    getTitle_Number(){
        return this.Title_Number;
    }
    setTitle_Number(Title_Number){
        this.Title_Number = Title_Number;
    }
}
class TypeUser{
    Id_Info;
    User;
    getId_Info(){
        return this.Id_Info;
    }
    setId_Info(Id_Info){
        this.Id_Info = Id_Info;
    }
    getUser(){
        return this.User;
    }
    setUser(Title_Number){
        this.Title_Number = Title_Number;
    }
 
}
export {TypeTitle,TypeUser}