DROP TRIGGER cad_reuniao_profile_INS;
CREATE  TRIGGER cad_reuniao_profile_INS 
AFTER INSERT ON cad_reuniao 

    FOR EACH ROW 
    BEGIN
    SELECT DATA,HORA,LOCAL
  	     into
	     @reuniaodata,@reuniaohora,@reuniaolocal
    	 FROM cad_reuniao

    WHERE id = (select min(id) 
							   from
							   cad_reuniao
							   where
							   data >= DATE(NOW()));
    
    	update tb_profile
        		set Reuniao_data = @reuniaodata,
                	Reuniao_hora = @reuniaohora,
                    Reuniao_local = @reuniaolocal;
    END;
DROP TRIGGER cad_reuniao_profile_upd;    
CREATE  TRIGGER cad_reuniao_profile_UPD
AFTER UPDATE ON cad_reuniao 

    FOR EACH ROW 
    BEGIN
    SELECT DATA,HORA,LOCAL
  	     into
	     @reuniaodata,@reuniaohora,@reuniaolocal
    	 FROM cad_reuniao

    WHERE id = (select min(id) 
							   from
							   cad_reuniao
							   where
							   data >= DATE(NOW()));

    	update tb_profile
        		set Reuniao_data = @reuniaodata,
                	Reuniao_hora = @reuniaohora,
                    Reuniao_local = @reuniaolocal;

    END;
    
    
    
    update cad_reuniao set local=local