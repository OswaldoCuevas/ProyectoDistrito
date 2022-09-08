import * as Document from "./Document.js";

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

export {listDocument};

