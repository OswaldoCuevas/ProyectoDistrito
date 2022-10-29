class transferTitle{
    _Transfer_Date 
    _Title_Id 
    _Transfers_Id 
    _namePrevious 
    _nameNew
    _idPrevious 
    _idNew 
    _Title_Number
    _Actual

    constructor(Transfer_Date,Title_Id,Transfers_Id,namePrevious,nameNew,idPrevious,idNew,Title_Number,Actual ){
        this.setTransfer_Date(Transfer_Date);
        this.setTitle_Id(Title_Id);
        this.setTransfers_Id(Transfers_Id);
        this.setnamePrevious(namePrevious);
        this.setnameNew(nameNew);
        this.setidPrevious(idPrevious);
        this.setidNew(idNew);
        this.setTitle_Number(Title_Number);
        this.setActual(Actual);
    }
    getActual() {
        return this._Actual
    }
    setActual(value) {
        this._Actual = value
    }  
    getTransfer_Date() {
        return this._Transfer_Date
    }
    setTransfer_Date(value) {
        this._Transfer_Date = value
    }
    getTitle_Id() {
        return this._Title_Id
    }
    setTitle_Id(value) {
        this._Title_Id = value
    }
    getTransfers_Id() {
        return this._Transfers_Id
    }
    setTransfers_Id(value) {
        this._Transfers_Id = value
    }  
    getnamePrevious() {
        return this._namePrevious
    }
    setnamePrevious(value) {
        this._namePrevious = value
    }
    getnameNew() {
        return this._nameNew
    }
    setnameNew(value) {
        this._nameNew = value
    }
    getidPrevious() {
        return this._idPrevious
    }
    setidPrevious(value) {
        this._idPrevious = value
    }
    getidNew() {
        return this._idNew
    }
    setidNew(value) {
        this._idNew = value
    }
    getTitle_Number() {
        return this._Title_Number
    }
    setTitle_Number(value) {
        this._Title_Number = value
    }
}
export {transferTitle};