class user{
    _Control_Num;
    _Full_Name;
    _Email;
    _Password_User;
    _RFC;
    _CURP;
    _Type_User;
    _Phone_Number;
   
    constructor(Control_Num,Full_Name,Email,Password_User,RFC,CURP,Type_User,Phone_Number){
        this.setControl_Num(Control_Num);
        this.setFull_Name(Full_Name);
        this.setEmail(Email);
        this.setPassword_User(Password_User);
        this.setRFC(RFC);
        this.setCURP(CURP);
        this.setType_User(Type_User);
        this.setPhone_Number(Phone_Number);
        
        
    }
    getControl_Num() {
        return this._Control_Num;
    }
    setControl_Num(value) {
        this._Control_Num = value;
    }
    
    getFull_Name() {
        return this._Full_Name;
    }
    setFull_Name(value) {
        this._Full_Name = value;
    }
   
    getEmail() {
        return this._Email;
    }
    setEmail(value) {
        this._Email = value;
    }
    
    getPassword_User() {
        return this._Password_User;
    }
    setPassword_User(value) {
        this._Password_User = value;
    }
   
    getRFC() {
        return this._RFC;
    }
    setRFC(value) {
        this._RFC = value;
    }

    getCURP() {
        return this._CURP;
    }
    setCURP(value) {
        this._CURP = value;
    }

    getType_User() {
        return this._Type_User;
    }
    setType_User(value) {
        this._Type_User = value;
    }
    getPhone_Number() {
        return this._Phone_Number;
    }
    setPhone_Number(value) {
        this._Phone_Number = value;
    }

}
export {user}