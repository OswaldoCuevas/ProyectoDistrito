class user{
    _Control_Num;
    _Full_Name;
    _Email;
    _Password_User;
    _RFC;
    _CURP;
    _Type_User;
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
}
export {user}