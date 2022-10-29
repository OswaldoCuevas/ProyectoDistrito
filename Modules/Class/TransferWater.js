class transferWater{
    _Transfers_Id   = null;
    _Date_Start     = null;
    _Date_End       = null;
    _Amount         = null;
    _SetTitleNumber = null;
    _GetTitleNumber = null; 
    _SetTitleId     = null;
    _GetTitleId     = null;
    _SetName        = null;
    _GetName        = null;
    _SetControl_Num = null;
    _GetControl_Num = null;
  
    constructor(Transfers_Id,Date_Start,Date_End,Amount,SetTitleNumber,GetTitleNumber,SetTitleId,GetTitleId,SetName,GetName,SetControl_Num,GetControl_Num){
        this.setTransfers_Id(Transfers_Id);
        this.setDate_Start(Date_Start);
        this.setDate_End(Date_End);
        this.setAmount(Amount);
        this.setSetTitleNumber(SetTitleNumber);
        this.setGetTitleNumber(GetTitleNumber);
        this.setSetTitleId(SetTitleId);
        this.setGetTitleId(GetTitleId);
        this.setSetName(SetName);
        this.setGetName(GetName);
        this.setSetControl_Num(SetControl_Num);
        this.setGetControl_Num(GetControl_Num);
    }
    getTransfers_Id() {
        return this._Transfers_Id
    }
    setTransfers_Id(value) {
        this._Transfers_Id = value
    }

    getDate_Start() {
        return this._Date_Start
    }
    setDate_Start(value) {
        this._Date_Start = value
    }
  
    getDate_End() {
        return this._Date_End
    }
    setDate_End(value) {
        this._Date_End = value
    }
 
    getAmount() {
        return this._Amount
    }
    setAmount(value) {
        this._Amount = value
    }
 
    getSetTitleNumber() {
        return this._SetTitleNumber
    }
    setSetTitleNumber(value) {
        this._SetTitleNumber = value
    }

    getGetTitleNumber() {
        return this._GetTitleNumber
    }
    setGetTitleNumber(value) {
        this._GetTitleNumber = value
    }
   
    getSetTitleId() {
        return this._SetTitleId
    }
    setSetTitleId(value) {
        this._SetTitleId = value
    }
   
    getGetTitleId() {
        return this._GetTitleId
    }
    setGetTitleId(value) {
        this._GetTitleId = value
    }
    getSetName() {
        return this._SetName;
    }
    setSetName(value) {
        this._SetName = value;
    }
   
    getGetName() {
        return this._GetName;
    }
    setGetName(value) {
        this._GetName = value;
    }
    
    getSetControl_Num() {
        return this._SetControl_Num;
    }
    setSetControl_Num(value) {
        this._SetControl_Num = value;
    }
   
    getGetControl_Num() {
        return this._GetControl_Num;
    }
    setGetControl_Num(value) {
        this._GetControl_Num = value;
    }
}
export{transferWater};