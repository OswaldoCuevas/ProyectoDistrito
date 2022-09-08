class Element{
    Id_Info;
    Elements;
    constructor(Id_Info,Elements){
        this.setId_Info(Id_Info);
        this.setElements(Elements);
    }
    getId_Info(){
        return this.Id_Info;
    }
    setId_Info(Id_Info){
        this.Id_Info = Id_Info;
    }
    getElements(){
        return this.Elements;
    }
    setElements(Elements){
        this.Elements = Elements;
    }
}

export {Element}