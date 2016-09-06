<?php
class Application_Model_CadastroMapper {
		
	public function buscaNomePaisTraduzido($locale) {
		
		$zendAdapter = new Zend_Db_Table ();

		$locale = strtolower($locale);
		
		if($locale == 'en')
			$locale = 'pt_br';
		else
			$locale = 'en_us';
			
		$select = $zendAdapter->getDefaultAdapter()->select()
					->from(array('pai' => 'pais'), array('pai_codigo', 'pai_nome' => "pai_nome_{$locale}"))
					->order('pai_nome ASC');
		
		return $zendAdapter->getDefaultAdapter()->fetchAll($select);
	}
	
	public function find($clcCodigo){
		$adapter = Zend_Db_Table::getDefaultAdapter();
		$select = $adapter->select()->from(array('clc' => 'cliente_callcenter'))
			->where('clc_codigo = ?', $clcCodigo);
		
		return $adapter->fetchRow($select);
	}
	
	public function findPedidoCliente($clcCodigo, $pedCodigo){
		$adapter = Zend_Db_Table::getDefaultAdapter();
		$select = $adapter->select()->from(array('ccp' => 'cliente_callcenter_pedido'))
		->where('clc_codigo = ?', $clcCodigo)
		->where('ped_codigo = ?', $pedCodigo);
	
		return $adapter->fetchRow($select);
	}
	
	
	public function buscaUsuarioCallCenter(array $dados){
		$adapter = Zend_Db_Table::getDefaultAdapter();
		$select = $adapter->select()->from(array('clc' => 'cliente_callcenter'))
			->joinLeft(array('gtt' => 'geral_tipo_telefone'), 'gtt.gtt_codigo = clc.gtt_codigo', array('gtt_nome'))
			->joinLeft(array('cid' => 'cidade'), 'cid.cid_codigo = clc.cid_codigo', array('cid_nome'))
			->joinLeft(array('est' => 'estado'), 'est.est_codigo = cid.est_codigo', array('est_nome', 'est_codigo'))
			->joinLeft(array('pai' => 'pais'), 'pai.pai_codigo = est.pai_codigo', array('pai_nome', 'pai_codigo'));
		
		if(isset($dados['name']) && !empty($dados['name']))
			$select->where("clc_nome + ' ' + clc_sobrenome LIKE ?", "%{$dados['name']}%");
		
		if(isset($dados['email']) && !empty($dados['email']))
			$select->where('clc_email = ?', $dados['email']);
		
		return $adapter->fetchAll($select);
	}
	
	public function findEstados($paiCodigo) {
	
		$zendAdapter = new Zend_Db_Table ();
	
		$select = $zendAdapter->getDefaultAdapter()->select()
		->from(array('est' => 'estado'), array('est_codigo', 'est_nome'))
		->where('pai_codigo = ?', $paiCodigo)
		->order('est_nome');
	
		return $zendAdapter->getDefaultAdapter()->fetchAll($select);
	}
	
	public function findCidades($estCodigo) {
	
		$zendAdapter = new Zend_Db_Table ();
	
		$select = $zendAdapter->getDefaultAdapter()->select()
		->from(array('cid' => 'cidade'), array('cid_codigo', 'cid_nome'))
		->where('est_codigo = ?', $estCodigo)
		->order('cid_nome');
	
		return $zendAdapter->getDefaultAdapter()->fetchAll($select);
	}
	
	public function findEstado($estCodigo) {
	
		$zendAdapter = new Zend_Db_Table ();
	
		$select = $zendAdapter->getDefaultAdapter()->select()
		->from(array('est' => 'estado'), array('est_codigo', 'est_nome', 'pai_codigo'))
		->where('est_codigo = ?', $estCodigo)
		->order('est_nome');
	
		return $zendAdapter->getDefaultAdapter()->fetchRow($select);
	}
	
	public function findCidade($cidCodigo) {
	
		$zendAdapter = new Zend_Db_Table ();
	
		$select = $zendAdapter->getDefaultAdapter()->select()
		->from(array('cid' => 'cidade'), array('cid_codigo', 'cid_nome', 'est_codigo'))
		->where('cid_codigo = ?', $cidCodigo)
		->order('cid_nome');
	
		return $zendAdapter->getDefaultAdapter()->fetchRow($select);
	}
	
	/**
	 * Insere um novo cliente
	 * @param array $array
	 * @return string
	 */
	public function insertClient ($array) {
		//var_dump($array['clc_nome']);exit;
		$zendAdapter = Zend_Db_Table::getDefaultAdapter();
		$zendAdapter->insert('cliente_callcenter', array(
				'clc_nome' => $array['clc_nome'],
				'clc_sobrenome' => $array['clc_sobrenome'],
				'clc_data_aniversario' => empty($array['clc_data_aniversario']) ? null : $array['clc_data_aniversario'],
				'clc_sexo' => $array['clc_sexo'],
				'clc_telefone' => $array['clc_telefone'],
				'gtt_codigo' => $array['gtt_codigo'],
				'clc_cep' => $array['clc_cep'],
				'clc_endereco' => $array['clc_endereco'],
				'cid_codigo' => $array['cid_codigo'],
				'clc_email' => $array['clc_email'],
		));
		
		return $zendAdapter->lastInsertId();

	}
	
	/**
	 * Altera os dados do cliente.
	 * 
	 * @param array $params        	
	 * @return number
	 */
	public function alterarClient($params) {
		$zendAdapter = Zend_Db_Table::getDefaultAdapter ();
		$rows = $zendAdapter->update ( 'cliente_callcenter', array (
				'clc_nome' => $params ['clc_nome'],
				'clc_sobrenome' => $params ['clc_sobrenome'],
				'clc_data_aniversario' => empty ( $params ['clc_data_aniversario'] ) ? null : $params ['clc_data_aniversario'],
				'clc_sexo' => $params ['clc_sexo'],
				'clc_telefone' => $params ['clc_telefone'],
				'gtt_codigo' => $params ['gtt_codigo'],
				'clc_cep' => $params ['clc_cep'],
				'clc_endereco' => $params ['clc_endereco'],
				'cid_codigo' => $params ['cid_codigo'],
				'clc_email' => $params ['clc_email'] 
		), "clc_codigo = {$params['clc_codigo']}" );
		
		return $rows;
	}

	public function alterarClientPassword ($password, $idCliente, $pedCodigo) {
	
		$zendAdapter = Zend_Db_Table::getDefaultAdapter();
		$rows = $zendAdapter->update('cliente_callcenter_pedido', array(
				'ccp_senha' => $password,
		), "clc_codigo = {$idCliente} AND ped_codigo = {$pedCodigo}");
	
		return $rows;
	
	}

	public function insertClientCallcenterPedido ($clcCodigo, $pedCodigo) {
	
		$zendAdapter = Zend_Db_Table::getDefaultAdapter();
		$zendAdapter->insert('cliente_callcenter_pedido', array(
				'clc_codigo' => $clcCodigo,
				'ped_codigo' => $pedCodigo,
		));
	
		return $zendAdapter->lastInsertId();
	
	}
	
	public function insertLogClienteCallCenter ($ccpCodigo, $clcEmail, $tipoAcao) {
	
		$session = new Zend_Session_Namespace ( 'auth_user' );
		
		$zendAdapter = Zend_Db_Table::getDefaultAdapter();
		$zendAdapter->insert('log_pedido_callcenter_email', array(
				'usu_codigo' => $session->dados->usu_codigo,
				'ccp_codigo' => $ccpCodigo,
				'clc_email' => $clcEmail,
				'lpc_tipo_acao' => $tipoAcao,
				'lpc_data' => new Zend_Db_Expr('GETDATE()'),
		));
	
		return $zendAdapter->lastInsertId();
	
	}
	
	
	/**
	 * 
	 * @param int $pedCodigo
	 * @return array
	 */
	public function getDadosEmailEnviado($pedCodigo){
		$adapter = Zend_Db_Table::getDefaultAdapter();
		$select = $adapter->select()->from(array('cca' => 'cliente_callcenter', array('*')))
					->joinInner(array('ccp' => 'cliente_callcenter_pedido'), 'cca.clc_codigo = ccp.clc_codigo', array(''))
					->joinInner(array('lpc' => 'log_pedido_callcenter_email'), 'lpc.ccp_codigo = ccp.ccp_codigo', array('email' => 'lpc.clc_email', 'lpc_tipo_acao', 'lpc_data'))
					->joinInner(array('usu' => 'acl_usuario'), 'lpc.usu_codigo = usu.usu_codigo', array('usu_login'))
					->where('ccp.ped_codigo = ?', $pedCodigo);
	
// 		echo '<pre>'; var_dump($select->assemble());exit;
		
		return $adapter->fetchAll($select);
	}
	
}
