DROP TRIGGER cad_usuario_ins;
CREATE  TRIGGER cad_usuario_ins 
AFTER INSERT ON `cad_usuario`

    FOR EACH ROW 
    BEGIN

    	select sum(case when aprovado = 'S' then 1 else 0 END) socios,
  	           sum(case when aprovado = 'S' then 0 else 1 END) opaleiros
               into @qtde_socios,@qtde_opaleiros
               from cad_usuario;
        
    	update tb_profile
        		set Usuario_ultimo = new.userid,
                	Usuario_qtde =  @qtde_socios + @qtde_opaleiros,
                    Usuario_socios_qtde = @qtde_socios,
                    Usuario_opaleiros_qtde =  @qtde_opaleiros
                    ;
    END;

DROP TRIGGER cad_usuario_upd;
CREATE  TRIGGER cad_usuario_upd 
AFTER UPDATE ON `cad_usuario`

    FOR EACH ROW 
    BEGIN
    

    	select sum(case when aprovado = 'S' then 1 else 0 END) socios,
  	           sum(case when aprovado = 'S' then 0 else 1 END) opaleiros
               into @qtde_socios,@qtde_opaleiros
               from cad_usuario;
        
    	update tb_profile
        		set Usuario_qtde =  @qtde_socios + @qtde_opaleiros,
                    Usuario_socios_qtde = @qtde_socios,
                    Usuario_opaleiros_qtde =  @qtde_opaleiros
                    ;
    END;
