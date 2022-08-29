import * as Document from "./Document.js";

class TypeTitle {
    Titles_Number = [];
  
    setArrayTitles_Number = (Id_Info,Title_Number) => {
        this.Titles_Number.push(new Document.TypeTitle(Id_Info,Title_Number));
    }
    getArrayTitles_Number () {
         return this.Titles_Number;   
    }
    
    dropTitle(id){
        
        this.Titles_Number = this.Titles_Number.filter(word => word.Id_Info != id);
    }
    searchTitle(id) {
        for(var i=0 ;i<this.Titles_Number.length;i++){
            if(this.Titles_Number[i].Id_Info==id){
                return i+1;
            }
        }
    }
}
export {TypeTitle};

