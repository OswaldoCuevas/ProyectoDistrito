/*Nombre de tabla*/ 
Create table Users(                 Control_Num         INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL,
                                    Full_Name           VARCHAR(400)                                        NULL,
                                    Phone_Number        VARCHAR(200)                                         NULL,
                                    Email               VARCHAR(200)                                        NULL,
                                    Password_User       VARCHAR(50)                                         NULL,
                                    RFC                 VARCHAR(200)                                         NULL,
                                    CURP                VARCHAR(200)                                         NULL,
                                    Type_User           VARCHAR(30)                                         NULL,
                                    INE                 VARCHAR(15)                                         NULL,
                                    INDEX                               Index_user_name(Full_Name)
                    );

Create table Updates(               Update_Id           INT             PRIMARY KEY  AUTO_INCREMENT     NOT NULL,
                                    User_Admin          INT                                             NOT NULL,
                                    Type_Update         VARCHAR(20)                                         NULL,
                                    Message_Update      TEXT                                                NULL,
                                    Update_Date         DATETIME                                            NULL,
                                    INDEX                               Index_Type_Update(Type_Update),
                                    INDEX                               Index_User_Admin(User_Admin),
                                    INDEX                               Index_Update_Date(Update_Date),
                                    FOREIGN KEY                         (User_Admin)
                                    REFERENCES                          Users(Control_Num)
                     );

Create table Transfers_Thousands(   Transfers_Id        INT             PRIMARY KEY  AUTO_INCREMENT     NOT NULL,
                                    SetUser             INT                                             NOT NULL,
                                    GetUser             INT                                             NOT NULL,
                                    Transfer_Validity   INT                                             NOT NULL,
                                    Transfer_Date       DATE                                            NOT NULL,
                                    Amount              INT                                             NOT NULL,
                                    INDEX                               Index_SetUser(SetUser),
                                    INDEX                               Index_getUser(GetUser),
                                    FOREIGN KEY                         (SetUser)
                                    REFERENCES                          Users(Control_Num),
                                    FOREIGN KEY                         (GetUser)
                                    REFERENCES                          Users(Control_Num)
                                );
Create Table Titles(                Title_Id            INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL,
                                    User_Id             INT                                             NOT NULL,
                                    Title_Number        VARCHAR(20)                                         NULL,
                                    Water_Supply        INT                                                 NULL,
                                    Initial_Date        DATE                                                NULL,
                                    Validity            INT                                                 NULL,
                                    Extend              TEXT                                                NULL,
                                    Tenant              VARCHAR(400)                                        NULL,
                                    Active              BOOLEAN                                             NULL,
                                    INDEX                               Index_User_Id(User_Id),
                                    INDEX                               Index_Title_Number(Title_Number),
                                    FOREIGN KEY                         (User_Id)
                                    REFERENCES                          Users(Control_Num)
                                    
                    );

       
Create Table Location_Title(        Location_Id         INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL,
                                    Title_Id            INT                                             NOT NULL,
                                    Cologne             VARCHAR(30)                                         NULL,
                                    Plot                VARCHAR(20)                                         NULL,
                                    Longitude           VARCHAR(20)                                         NULL,
                                    Latitude            VARCHAR(20)                                         NULL,
                                    Active              BOOLEAN                                             NULL,
                                    INDEX                               Index_Cologne(Cologne),
                                    INDEX                               Index_Plot(Plot),
                                    INDEX                               Index_Title_Id(Title_Id),
                                    FOREIGN KEY                         (Title_Id)
                                    REFERENCES                          Titles(Title_Id)
                            );

Create Table Investments(           Investments_Id      INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL,
                                    Location_Id         INT                                             NOT NULL,
                                    User_Id             INT                                             NOT NULL,
                                    System_             VARCHAR(100)                                        NULL,
                                    Hectare             INT                                                 NULL,
                                    Investments_Date    INT                                                NULL,
                                    INDEX                               Index_Location_Id(Location_Id),
                                    INDEX                               Index_User_Id(User_Id),
                                    FOREIGN KEY                         (Location_Id) 
                                    REFERENCES                          Location_Title(Location_Id),
                                    FOREIGN KEY                         (User_Id) 
                                    REFERENCES                          Users(Control_Num)  
                         );

Create Table Transfers_Title(       Transfers_Id        INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL,
                                    Previous_User       INT                                             NOT NULL,
                                    New_User            INT                                             NOT NULL,
                                    Title_Id            INT                                             NOT NULL,
                                    Transfer_Date       DATE                                            NOT NULL,
                                    INDEX                               Index_Previous_User(Previous_User),
                                    INDEX                               Index_New_User(New_User),
                                    INDEX                               Index_Title_Id(Title_Id),
                                    FOREIGN KEY                         (Previous_User) 
                                    REFERENCES                          Users(Control_Num),
                                    FOREIGN KEY                         (New_User) 
                                    REFERENCES                          Users(Control_Num),
                                    FOREIGN KEY                         (Title_Id) 
                                    REFERENCES                          Titles(Title_Id)
                             );

Create Table Change_Location (      Change_Id           INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL,
                                    Title_Id            INT                                             NOT NULL,
                                    Previous_Location   INT                                             NOT NULL,
                                    New_Location        INT                                             NOT NULL,
                                    Change_Date         Date                                                NULL,
                                    INDEX                               Index_Title_Id(Title_Id),
                                    INDEX                               Index_Previous_Location(Previous_Location),
                                    INDEX                               Index_New_Location(New_Location),
                                    FOREIGN KEY                         (Title_Id) 
                                    REFERENCES                          Titles(Title_Id),
                                    FOREIGN KEY                         (Previous_Location )
                                    REFERENCES                          Location_Title(Location_Id),
                                    FOREIGN KEY                         (New_Location )
                                    REFERENCES                          Location_Title(Location_Id)

                                 
                              );

Create table Documents (            Document_Id         INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL, 
                                    Document_Name       VARCHAR(255)                                    NOT NULL,
                                    Document_Type       VARCHAR(255)                                    NOT NULL,
                                    Document_Year       INT                                             NOT NULL 
                        );

Create table Document_Info(         Info_Id             INT             PRIMARY KEY AUTO_INCREMENT      NOT NULL,
                                    Document_Id         INT                                             NOT NULL,
                                    Program             INT                                                 NULL,
                                    User                VARCHAR(400)                                        NULL,
                                    Type_User           VARCHAR(30)                                         NULL,
                                    Cologne             VARCHAR(80)                                         NULL,
                                    Plot                VARCHAR(80)                                         NULL,
                                    Title_Number        VARCHAR(40)                                         NULL,
                                    Validity            INT                                                 NULL,
                                    Initial_Date        Date                                                NULL,
                                    Water_Supply        INT                                                 NULL,
                                    Longitude           VARCHAR(20)                                         NULL,
                                    Latitude            VARCHAR(20)                                         NULL,
                                    System_             VARCHAR(100)                                        NULL,
                                    Hectare             INT                                                 NULL,
                                    Investments_Date    INT                                                 NULL,
                                    RFC                 VARCHAR(200)                                         NULL,
                                    CURP                VARCHAR(200)                                         NULL,
                                    Extend              TEXT                                                NULL,
                                    INE                 VARCHAR(15)                                         NULL,
                                    Phone_Number        VARCHAR(200)                                         NULL,
                                    Tenant              VARCHAR(400)                                        NULL,
                                    Email               VARCHAR(200)                                        NULL,  
                                    INDEX                               Index_User(User),
                                    INDEX                               Index_Plot(Plot),
                                    INDEX                               Index_Title_Number(Title_Number),
                                    INDEX                               Index_Cologne(Cologne),
                                    INDEX                               Index_Document_Id (Document_Id),
                                    FOREIGN KEY                         (Document_Id) 
                                    REFERENCES                          Documents(Document_Id)


                                    );

Create VIEW  Document_type_Titles AS  SELECT        documents.Document_Id,
                                                    document_info.Info_Id,
                                                    document_info.Program,
                                                    document_info.User,
                                                    document_info.Type_User,
                                                    document_info.Cologne,
                                                    document_info.Plot,
                                                    document_info.Title_Number,
                                                    document_info.Initial_Date,
                                                    document_info.Water_Supply,
                                                    document_info.Longitude,
                                                    document_info.Latitude,
                                                    document_info.Validity,
                                                    document_info.Extend,
                                                    document_info.Tenant
                                                    from documents,document_info where 
                                                    documents.document_id=document_info.document_id
                                                    AND 
                                                    documents.document_type="Títulos"
                                                    AND documents.Active = 1;

Create VIEW Document_Users AS  SELECT               documents.Document_Id,
                                                    document_info.Info_Id,
                                                    document_info.Program,
                                                    document_info.User, 
                                                    document_info.Phone_Number,
                                                    document_info.RFC,
                                                    document_info.CURP,
                                                    document_info.INE,
                                                    document_info.Email
                                                    from documents,document_info where
                                                    documents.document_id=document_info.document_id                                                 
                                                    AND 
                                                    documents.document_type="Padrón de usuarios"
                                                    AND documents.Active = 1;    


Create VIEW Document_type_Investments AS  SELECT    documents.Document_Id,
                                                    document_info.Info_Id,
                                                    document_info.Program,
                                                    document_info.User,
                                                    document_info.Cologne,
                                                    document_info.Plot,
                                                    document_info.System_ ,
                                                    document_info.Hectare,
                                                    document_info.Investments_Date 
                                                    from documents,document_info where 
                                                    documents.document_id=document_info.document_id                                                 
                                                    AND 
                                                    documents.document_type="Inversiones"
                                                    AND documents.Active = 1;      

create view view_titles_update as select            titles.Title_Id,
                                                    location_title.Location_Id,
                                                    titles.User_Id,
                                                    titles.Title_Number,
                                                    users.Full_Name,
                                                    users.Type_User,
                                                    location_title.Cologne,
                                                    location_title.Plot,
                                                    titles.Initial_Date,
                                                    titles.Water_Supply,
                                                    location_title.Longitude,
                                                    location_title.Latitude,
                                                    titles.Validity,
                                                    titles.Extend,
                                                    titles.Tenant 
                                                    from titles,users,location_title 
                                                        where titles.Title_Id = location_title.Title_Id
                                                        AND   titles.User_Id = users.Control_Num
                                                        AND titles.Activo = 1
                                                        AND location_title.Active = 1
                                                        AND users.Active = 1;
Create view view_investments as  SELECT 
                                                    users.Control_Num,
                                                    investments.Investments_Id,
                                                    users.Full_Name, 
                                                    investments.Plot,
                                                    investments.Cologne,
                                                    investments.System_,
                                                    investments.Hectare,
                                                    investments.Investments_Date 
                                                   from investments,users
                                                    where investments.User_Id = users.Control_Num;  

Create view Padron_de_Usuarios as SELECT * FROM users WHERE Activo = 1 AND (Type_User IS NULL or Type_User = "Privado" or Type_User ="Social");
Create view Administradores as SELECT * FROM users WHERE Activo = 1 AND Type_User == 'Admin' or Type_User == 'Privileged_Admin';
Create VIEW consult_Padron as SELECT users.Control_Num, users.Type_User, users.Full_Name ,location_title.Cologne,location_title.Plot,users.RFC,users.CURP FROM users,titles,location_title
WHERE users.Control_Num = User_Id
AND titles.Title_Id = location_title.Title_Id
AND location_title.active=1
AND users.activo =1
AND titles.active=1;
;
create view inversiones as SELECT * FROM investments,users 
                            where  investments.User_Id = users.Control_Num 
                            AND investments.Active = 1
                            AND users.Activo = 1;