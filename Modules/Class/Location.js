class location{
    _Change_Id 
    _Title_Id
    _Change_Date
    _Plot1
    _Cologne1 
    _Longitude1
    _Latitude1 
    _Plot2  
    _Cologne2
    _Longitude2  
    _Latitude2 

    constructor(Change_Id,Title_Id,Change_Date,Plot1,Cologne1,Longitude1,Latitude1,Plot2,Cologne2,Longitude2,Latitude2){
        this.setChange_Id(Change_Id);
        this.setTitle_Id(Title_Id);
        this.setChange_Date(Change_Date);
        this.setPlot1(Plot1);
        this.setCologne1(Cologne1);
        this.setLongitude1(Longitude1);
        this.setLatitude1(Latitude1);
        this.setPlot2(Plot2);
        this.setCologne2(Cologne2);
        this.setLongitude2(Longitude2);
        this.setLatitude2(Latitude2);
    }

    getChange_Id() {
        return this._Change_Id
    }
    setChange_Id(value) {
        this._Change_Id = value
    }
    
    getTitle_Id() {
        return this._Title_Id
    }
    setTitle_Id(value) {
        this._Title_Id = value
    }
    
    getChange_Date() {
        return this._Change_Date
    }
    setChange_Date(value) {
        this._Change_Date = value
    }
  
    getPlot1() {
        return this._Plot1
    }
    setPlot1(value) {
        this._Plot1 = value
    }
   
    getCologne1() {
        return this._Cologne1
    }
    setCologne1(value) {
        this._Cologne1 = value
    }
      
    getLongitude1() {
        return this._Longitude1
    }
    setLongitude1(value) {
        this._Longitude1 = value
    }
    
    getLatitude1() {
        return this._Latitude1
    }
    setLatitude1(value) {
        this._Latitude1 = value
    }
    
    getPlot2() {
        return this._Plot2
    }
    setPlot2(value) {
        this._Plot2 = value
    }
   
    getCologne2() {
        return this._Cologne2
    }
    setCologne2(value) {
        this._Cologne2 = value
    }
    
    getLongitude2() {
        return this._Longitude2
    }
    setLongitude2(value) {
        this._Longitude2 = value
    }
    
    getLatitude2() {
        return this._Latitude2
    }
    setLatitude2(value) {
        this._Latitude2 = value
    }
   
}
export{location};