
class title{
    Title_Id;
    User_Id;
    Location_Id;
    Full_Name;
    Tenant;
    Title_Number;
    Water_Supply;
    Initial_Date;
    Validity;
    Extend;
    Cologne; 
    Plot;
    Longitude;
    Latitude;
    constructor(Title_Id,User_Id,Location_Id,Full_Name,Tenant,Title_Number,Water_Supply,Initial_Date,Validity,Extend,Cologne,Plot,Longitude,Latitude){
        this.setTitle_Id(Title_Id);
        this.setUser_Id(User_Id);
        this.setLocation_Id(Location_Id);
        this.setFull_Name(Full_Name);
        this.setTenant(Tenant);
        this.setTitle_Number(Title_Number);
        this.setWater_Supply(Water_Supply);
        this.setInitial_Date(Initial_Date);
        this.setValidity(Validity);
        this.setExtend(Extend);
        this.setCologne(Cologne);
        this.setPlot(Plot);
        this.setLongitude(Longitude);
        this.setLatitude(Latitude);
    }
    getTitle_Id() {
        return this.Title_Id;
    }
    setTitle_Id(value) {
        this.Title_Id = value;
    }
   
    getUser_Id() {
        return this.User_Id;
    }
    setUser_Id(value) {
        this.User_Id = value;
    }
    getFull_Name() {
        return this.Full_Name;
    }
    setFull_Name(value) {
        this.Full_Name = value;
    }
    getTenant() {
        return this.Tenant;
    }
    setTenant(value) {
        this.Tenant = value;
    }
    getTitle_Number() {
        return this.Title_Number;
    }
    setTitle_Number(value) {
        this.Title_Number = value;
    }
   
    getWater_Supply() {
        return this.Water_Supply;
    }
    setWater_Supply(value) {
        this.Water_Supply = value;
    }
 
    getInitial_Date() {
        return this.Initial_Date;
    }
    setInitial_Date(value) {
        this.Initial_Date = value;
    }
    
    getValidity() {
        return this.Validity;
    }
    setValidity(value) {
        this.Validity = value;
    }
   
    getExtend() {
        return this.Extend;
    }
    setExtend(value) {
        this.Extend = value;
    }
    getCologne() {
        return this.Cologne;
    }
    setCologne(value) {
        this.Cologne = value;
    }
    getPlot() {
        return this.Plot;
    }
    setPlot(value) {
        this.Plot = value;
    }
    getLongitude() {
        return this.Longitude;
    }
    setLongitude(value) {
        this.Longitude = value;
    }
    getLatitude() {
        return this.Latitude;
    }
    setLatitude(value) {
        this.Latitude = value;
    }
    getLocation_Id() {
        return this.Location_Id;
    }
    setLocation_Id(value) {
        this.Location_Id = value;
    }
}
export {title}