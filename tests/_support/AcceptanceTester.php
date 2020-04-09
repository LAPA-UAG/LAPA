<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * @Given Eu crio um usuario para o teste
     */
    public function euCrioUmUsuarioParaOTeste()
    {
        $this->amOnPage('/register');
        $this->fillField(['name' => 'name'], 'Rodrigo');
        $this->fillField(['name' => 'cpf'], '11111111111');
        $this->fillField(['name' => 'email'], 'admin@admin.com');
        $this->fillField(['name' => 'password'], '12345678');
        $this->fillField(['name' => 'password_confirmation'], '12345678');
        $this->selectOption(['name' => 'isAdmin'], 'Sim');
        $this->click('Cadastrar');
    }

    /**
     * @Given Eu estou logado
     */
    public function euEstouLogado()
    {
        $this->amOnPage('/login');
        $this->fillField(['name' => 'email'], 'admin@admin.com');
        $this->fillField(['name' => 'password'], '12345678');
        $this->click('Login');
    }

    /**
     * @Then Eu deleto o usuario para o teste
     */
    public function euDeletoOUsuarioParaOTeste()
    {
        $this->amOnPage('/auth/registros');
        $this->seeInCurrentUrl('/auth/registros');
        $this->click('Deletar', '//table/tbody/tr/td[text()="Rodrigo"]/ancestor::tr/td[5]');
        //$this->seeInPopup('Tem certeza que deseja excluir a conta?'); // Para teste no chromedriver
        //$this->acceptPopup(); // Para teste no chromedriver
        $this->dontSee('Rodrigo');
    }

    /*==================================== A partir daqui metodos para feature Disciplina =======================
     */

    /**
     * @Given Eu estou na pagina de disciplinas
     */
    public function euEstouNaPaginaDeDisciplinas()
    {
        $this->amOnPage('/auth/disciplinas');
    }

   /**
    * @Given Eu clico em Adicionar
    */
    public function euClicoEmAdicionar()
    {
        $this->click('Adicionar');
    }

   /**
    * @Then Eu devo estar na pagina de criar disciplina
    */
    public function euDevoEstarNaPaginaDeCriarDisciplina()
    {
        $this->amOnPage('/auth/disciplina/adicionar');
    }

   /**
    * @When Eu preencho o campo nome com :arg1
    */
    public function euPreenchoOCampoNomeCom($arg1)
    {
        $this->fillField(['name' => 'nome'], $arg1);
    }

   /**
    * @When Eu seleciono o professor :arg1
    */
    public function euSelecionoOProfessor($arg1)
    {
        $this->selectOption(['name' => 'user_id'], $arg1);
    }

   /**
    * @Then Eu devo ver a disciplina :arg1
    */
    public function euDevoVerADisciplina($arg1)
    {
        $this->see($arg1, '//table/tbody/tr');
    }

    /**
     * @Given Eu clico em Editar a disciplina :arg1
     */
    public function euClicoEmEditarADisciplina($arg1)
    {
        $this->click('Editar', '//table/tbody/tr/td[text()="'.$arg1.'"]/ancestor::tr/td[3]');
    }

   /**
    * @Then Eu devo estar na pagina de editar a disciplina
    */
    public function euDevoEstarNaPaginaDeEditaraDisciplina()
    {
        $this->seeInCurrentUrl('/auth/disciplina/editar/');
    }

   /**
    * @When Eu edito o nome para :arg1
    */
    public function euEditoONomePara($arg1)
    {
        $this->fillField(['name' => 'nome'], $arg1);
    }

   /**
    * @When Eu clico em Editar
    */
    public function euClicoEmEditar()
    {
        $this->click('Editar');
    }

    /**
     * @When Eu edito o professor para :arg1
     */
    public function euEditoOProfessorPara($arg1)
    {
        $this->selectOption(['name' => 'user_id'], $arg1);
    }

   /**
    * @Then Eu devo ver o professor :arg1
    */
    public function euDevoVerOProfessor($arg1)
    {
        $this->see($arg1, '//table/tbody/tr');
    }


    /**
     * @Given Eu clico em Deletar a disciplina :arg1
     */
    public function euClicoEmDeletarADisciplina($arg1)
    {
        $this->click('Deletar', '//table/tbody/tr/td[text()="'.$arg1.'"]/ancestor::tr/td[3]');
        //$this->seeInPopup('Tem certeza que deseja deletar a disciplina?'); // Para teste no chromedriver
        //$this->acceptPopup(); // Para teste no chromedriver
    }

   /**
    * @Then Eu nao vejo a disciplina :arg1
    */
    public function euNaoVejoADisciplina($arg1)
    {
        $this->dontSee($arg1);
    }


    /*==================================== A partir daqui metodos para feature Postagem =======================
     */

     /**
     * @Given Eu estou na pagina de postagens
     */
    public function euEstouNaPaginaDePostagens()
    {
        $this->amOnPage('/auth/postagens');
    }

    
    /**
    * @Then Eu deve estar na pagina de criar postagem
    */
    public function euDeveEstarNaPaginaDeCriarPostagem()
    {
        $this->amOnPage('/auth/postagem/adicionar');
    }


   /**
    * @When Eu preencho o campo titulo com :arg1
    */
    public function euPreenchoOCampoTituloCom($arg1)
    {
        $this->fillField(['name' => 'titulo'], $arg1);
    }

    /**
     * @When Eu preencho o campo descricao com :arg1
     */
    public function euPreenchoOCampoDescricaoCom($arg1)
    {
        $this->fillField(['name' => 'descricao'], $arg1);
    }

    /**
     * @When Eu preencho o campo data com :arg1
     */
    public function euPreenchoOCampoDataCom($arg1)
    {
        $date = strtotime($arg1);
        $this->fillField(['name' => 'data'], date('Y-m-d', $date));  
    }


   /**
    * @When Eu clico em Escolher arquivo e escolho :arg1
    */
    public function euClicoEmEscolherArquivoEEscolho($arg1)
    {
        $this->attachFile(['name' => 'anexo'], $arg1);
    }

   /**
    * @Then Eu devo ver a postagem :arg1
    */
    public function euDevoVerAPostagem($arg1)
    {
        $this->see($arg1, '//table/tbody/tr');
    }
    
    /**
     * @Given Eu clico em Editar a postagem :arg1
     */
    public function euClicoEmEditarAPostagem($arg1)
    {
        $this->click('Editar', '//table/tbody/tr/td[text()="'.$arg1.'"]/ancestor::tr/td[5]');
    }

   /**
    * @Then Eu devo estar na pagina de editar a postagem
    */
    public function euDevoEstarNaPaginaDeEdicaoDaPostagem()
    {
        $this->seeInCurrentUrl('/auth/postagem/editar/');
    }

   /**
    * @When Eu edito o titulo para :arg1
    */
    public function euEditoOTituloPara($arg1)
    {
        $this->fillField(['name' => 'titulo'], $arg1);
    }

    /**
     * @When Eu edito a descricao para :arg1
     */
    public function euEditoADescricaoPara($arg1)
    {
        $this->fillField(['name' => 'descricao'], $arg1);
    }

    /**
     * @Then Eu devo ver como descricao da postagem :arg1
     */
    public function euDevoVerComoDescricaoDaPostagem($arg1)
    {
        $this->see($arg1, '//table/tbody/tr');
    }

    /**
     * @Given Eu clico em Deletar a postagem :arg1
     */
    public function euClicoEmDeletarAPostagem($arg1)
    {
        $this->click('Deletar', '//table/tbody/tr/td[text()="'.$arg1.'"]/ancestor::tr/td[5]');
        //$this->seeInPopup('Tem certeza que deseja deletar essa postagem?'); // Para teste no chromedriver
        //$this->acceptPopup(); // Para teste no chromedriver
    }

   /**
    * @Then Eu nao vejo a postagem :arg1
    */
    public function euNaoVejoAPostagem($arg1)
    {
        $this->dontSee($arg1);
    }

    /**
     * @When Eu edito o campo data com :arg1
     */
    public function euEditoOCampoDataCom($arg1)
    {
        $date = strtotime($arg1);
        $this->fillField(['name' => 'data'], date('Y-m-d', $date));  
    }

   /**
    * @Then Eu devo ver que a data mudou para :arg1
    */
    public function euDevoVerQueADataMudouPara($arg1)
    {
        $date = strtotime($arg1);
        $this->see(date('Y-m-d', $date), '//table/tbody/tr');
    }

    /**
     * @When Eu clico em Escolher arquivo editando o anexo para :arg1
     */
    public function euClicoEmEscolherArquivoEditandoOAnexoPara($arg1)
    {
        $this->attachFile(['name' => 'anexo'], $arg1);
    }

   /**
    * @Then Eu devo ver que o anexo mudou para :arg1
    */
    public function euDevoVerQueOAnexoMudouPara($arg1)
    {
        $this->dontSee($arg1, '//table/tbody/tr'); 
    }



}
