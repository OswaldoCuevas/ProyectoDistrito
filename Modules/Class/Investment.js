class investment{
  _Control_Num;
  _Investments_Id;
  _Full_Name;
  _Plot;
  _Cologne;
  _System_;
  _Hectare;
  _Investments_Date;
    constructor(_Control_Num, _Investments_Id, _Full_Name, _Plot, _Cologne, _System_, _Hectare, _Investments_Date){
        this.setControl_Num(_Control_Num);
        this.setInvestments_Id(_Investments_Id);
        this.setFull_Name(_Full_Name);
        this.setPlot(_Plot);
        this.setCologne(_Cologne);
        this.setSystem_(_System_);
        this.setHectare(_Hectare);
        this.setInvestments_Date(_Investments_Date);
    }
    getControl_Num() {
        return this._Control_Num;
    }
    setControl_Num(value) {
        this._Control_Num = value;
    }
 
    getInvestments_Id() {
        return this._Investments_Id;
    }
    setInvestments_Id(value) {
        this._Investments_Id = value;
    }

    getFull_Name() {
        return this._Full_Name;
    }
    setFull_Name(value) {
        this._Full_Name = value;
    }

    getPlot() {
        return this._Plot;
    }
    setPlot(value) {
        this._Plot = value;
    }
  
    getCologne() {
        return this._Cologne;
    }
    setCologne(value) {
        this._Cologne = value;
    }

    getSystem_() {
        return this._System_;
    }
    setSystem_(value) {
        this._System_ = value;
    }

    getHectare() {
        return this._Hectare;
    }
    setHectare(value) {
        this._Hectare = value;
    }

    getInvestments_Date() {
        return this._Investments_Date;
    }
    setInvestments_Date(value) {
        this._Investments_Date = value;
    }
}
export {investment};