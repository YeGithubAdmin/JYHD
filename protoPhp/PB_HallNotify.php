<?php
/**
 * Auto generated from PB_notify.proto at 2018-02-06 16:55:50
 */

namespace {
/**
 * PB_HallNotify message
 */
class PB_HallNotify extends \ProtobufMessage
{
    /* Field index constants */
    const BK_NOTIFY = 2;
    const NEW_EMAIL = 3;
    const RES_MODIFY = 4;
    const BUY_NOTIFY = 5;
    const PLAYER_VIP = 6;
    const SHUTDOWN = 7;
    const VIP_BC = 8;
    const GOLD_BC = 9;
    const YUQUAN_BC = 10;
    const ITEM_BC = 11;
    const PHP_BC = 12;
    const DRAW_NOTIFY = 13;
    const RES_CHANGED = 14;
    const ATTR_CHANGE = 15;
    const CFG_CHANGED = 16;
    const CS_NEW_MSG = 17;
    const LITTLE_GAME_UPDATE = 18;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BK_NOTIFY => array(
            'name' => 'bk_notify',
            'required' => false,
            'type' => '\PB_Bankruptcy'
        ),
        self::NEW_EMAIL => array(
            'name' => 'new_email',
            'required' => false,
            'type' => '\PB_NewEmail'
        ),
        self::RES_MODIFY => array(
            'name' => 'res_modify',
            'required' => false,
            'type' => '\PB_ResChange'
        ),
        self::BUY_NOTIFY => array(
            'name' => 'buy_notify',
            'required' => false,
            'type' => '\PB_BuyGoods'
        ),
        self::PLAYER_VIP => array(
            'name' => 'player_vip',
            'required' => false,
            'type' => '\PB_PlayerVip'
        ),
        self::SHUTDOWN => array(
            'name' => 'shutdown',
            'required' => false,
            'type' => '\PB_Shutdown'
        ),
        self::VIP_BC => array(
            'name' => 'vip_bc',
            'required' => false,
            'type' => '\PB_VipBroadcast'
        ),
        self::GOLD_BC => array(
            'name' => 'gold_bc',
            'required' => false,
            'type' => '\PB_GoldBroadcast'
        ),
        self::YUQUAN_BC => array(
            'name' => 'yuquan_bc',
            'required' => false,
            'type' => '\PB_YuquanBroadcast'
        ),
        self::ITEM_BC => array(
            'name' => 'item_bc',
            'required' => false,
            'type' => '\PB_ItemBroadcast'
        ),
        self::PHP_BC => array(
            'name' => 'php_bc',
            'required' => false,
            'type' => '\PB_PhpBroadcast'
        ),
        self::DRAW_NOTIFY => array(
            'name' => 'draw_notify',
            'required' => false,
            'type' => '\PB_DrawDataUpdate'
        ),
        self::RES_CHANGED => array(
            'name' => 'res_changed',
            'required' => false,
            'type' => '\PB_ResourceChange'
        ),
        self::ATTR_CHANGE => array(
            'name' => 'attr_change',
            'required' => false,
            'type' => '\PB_AttributeChange'
        ),
        self::CFG_CHANGED => array(
            'name' => 'cfg_changed',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CS_NEW_MSG => array(
            'name' => 'cs_new_msg',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::LITTLE_GAME_UPDATE => array(
            'name' => 'little_game_update',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::BK_NOTIFY] = null;
        $this->values[self::NEW_EMAIL] = null;
        $this->values[self::RES_MODIFY] = null;
        $this->values[self::BUY_NOTIFY] = null;
        $this->values[self::PLAYER_VIP] = null;
        $this->values[self::SHUTDOWN] = null;
        $this->values[self::VIP_BC] = null;
        $this->values[self::GOLD_BC] = null;
        $this->values[self::YUQUAN_BC] = null;
        $this->values[self::ITEM_BC] = null;
        $this->values[self::PHP_BC] = null;
        $this->values[self::DRAW_NOTIFY] = null;
        $this->values[self::RES_CHANGED] = null;
        $this->values[self::ATTR_CHANGE] = null;
        $this->values[self::CFG_CHANGED] = null;
        $this->values[self::CS_NEW_MSG] = null;
        $this->values[self::LITTLE_GAME_UPDATE] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'bk_notify' property
     *
     * @param \PB_Bankruptcy $value Property value
     *
     * @return null
     */
    public function setBkNotify(\PB_Bankruptcy $value=null)
    {
        return $this->set(self::BK_NOTIFY, $value);
    }

    /**
     * Returns value of 'bk_notify' property
     *
     * @return \PB_Bankruptcy
     */
    public function getBkNotify()
    {
        return $this->get(self::BK_NOTIFY);
    }

    /**
     * Sets value of 'new_email' property
     *
     * @param \PB_NewEmail $value Property value
     *
     * @return null
     */
    public function setNewEmail(\PB_NewEmail $value=null)
    {
        return $this->set(self::NEW_EMAIL, $value);
    }

    /**
     * Returns value of 'new_email' property
     *
     * @return \PB_NewEmail
     */
    public function getNewEmail()
    {
        return $this->get(self::NEW_EMAIL);
    }

    /**
     * Sets value of 'res_modify' property
     *
     * @param \PB_ResChange $value Property value
     *
     * @return null
     */
    public function setResModify(\PB_ResChange $value=null)
    {
        return $this->set(self::RES_MODIFY, $value);
    }

    /**
     * Returns value of 'res_modify' property
     *
     * @return \PB_ResChange
     */
    public function getResModify()
    {
        return $this->get(self::RES_MODIFY);
    }

    /**
     * Sets value of 'buy_notify' property
     *
     * @param \PB_BuyGoods $value Property value
     *
     * @return null
     */
    public function setBuyNotify(\PB_BuyGoods $value=null)
    {
        return $this->set(self::BUY_NOTIFY, $value);
    }

    /**
     * Returns value of 'buy_notify' property
     *
     * @return \PB_BuyGoods
     */
    public function getBuyNotify()
    {
        return $this->get(self::BUY_NOTIFY);
    }

    /**
     * Sets value of 'player_vip' property
     *
     * @param \PB_PlayerVip $value Property value
     *
     * @return null
     */
    public function setPlayerVip(\PB_PlayerVip $value=null)
    {
        return $this->set(self::PLAYER_VIP, $value);
    }

    /**
     * Returns value of 'player_vip' property
     *
     * @return \PB_PlayerVip
     */
    public function getPlayerVip()
    {
        return $this->get(self::PLAYER_VIP);
    }

    /**
     * Sets value of 'shutdown' property
     *
     * @param \PB_Shutdown $value Property value
     *
     * @return null
     */
    public function setShutdown(\PB_Shutdown $value=null)
    {
        return $this->set(self::SHUTDOWN, $value);
    }

    /**
     * Returns value of 'shutdown' property
     *
     * @return \PB_Shutdown
     */
    public function getShutdown()
    {
        return $this->get(self::SHUTDOWN);
    }

    /**
     * Sets value of 'vip_bc' property
     *
     * @param \PB_VipBroadcast $value Property value
     *
     * @return null
     */
    public function setVipBc(\PB_VipBroadcast $value=null)
    {
        return $this->set(self::VIP_BC, $value);
    }

    /**
     * Returns value of 'vip_bc' property
     *
     * @return \PB_VipBroadcast
     */
    public function getVipBc()
    {
        return $this->get(self::VIP_BC);
    }

    /**
     * Sets value of 'gold_bc' property
     *
     * @param \PB_GoldBroadcast $value Property value
     *
     * @return null
     */
    public function setGoldBc(\PB_GoldBroadcast $value=null)
    {
        return $this->set(self::GOLD_BC, $value);
    }

    /**
     * Returns value of 'gold_bc' property
     *
     * @return \PB_GoldBroadcast
     */
    public function getGoldBc()
    {
        return $this->get(self::GOLD_BC);
    }

    /**
     * Sets value of 'yuquan_bc' property
     *
     * @param \PB_YuquanBroadcast $value Property value
     *
     * @return null
     */
    public function setYuquanBc(\PB_YuquanBroadcast $value=null)
    {
        return $this->set(self::YUQUAN_BC, $value);
    }

    /**
     * Returns value of 'yuquan_bc' property
     *
     * @return \PB_YuquanBroadcast
     */
    public function getYuquanBc()
    {
        return $this->get(self::YUQUAN_BC);
    }

    /**
     * Sets value of 'item_bc' property
     *
     * @param \PB_ItemBroadcast $value Property value
     *
     * @return null
     */
    public function setItemBc(\PB_ItemBroadcast $value=null)
    {
        return $this->set(self::ITEM_BC, $value);
    }

    /**
     * Returns value of 'item_bc' property
     *
     * @return \PB_ItemBroadcast
     */
    public function getItemBc()
    {
        return $this->get(self::ITEM_BC);
    }

    /**
     * Sets value of 'php_bc' property
     *
     * @param \PB_PhpBroadcast $value Property value
     *
     * @return null
     */
    public function setPhpBc(\PB_PhpBroadcast $value=null)
    {
        return $this->set(self::PHP_BC, $value);
    }

    /**
     * Returns value of 'php_bc' property
     *
     * @return \PB_PhpBroadcast
     */
    public function getPhpBc()
    {
        return $this->get(self::PHP_BC);
    }

    /**
     * Sets value of 'draw_notify' property
     *
     * @param \PB_DrawDataUpdate $value Property value
     *
     * @return null
     */
    public function setDrawNotify(\PB_DrawDataUpdate $value=null)
    {
        return $this->set(self::DRAW_NOTIFY, $value);
    }

    /**
     * Returns value of 'draw_notify' property
     *
     * @return \PB_DrawDataUpdate
     */
    public function getDrawNotify()
    {
        return $this->get(self::DRAW_NOTIFY);
    }

    /**
     * Sets value of 'res_changed' property
     *
     * @param \PB_ResourceChange $value Property value
     *
     * @return null
     */
    public function setResChanged(\PB_ResourceChange $value=null)
    {
        return $this->set(self::RES_CHANGED, $value);
    }

    /**
     * Returns value of 'res_changed' property
     *
     * @return \PB_ResourceChange
     */
    public function getResChanged()
    {
        return $this->get(self::RES_CHANGED);
    }

    /**
     * Sets value of 'attr_change' property
     *
     * @param \PB_AttributeChange $value Property value
     *
     * @return null
     */
    public function setAttrChange(\PB_AttributeChange $value=null)
    {
        return $this->set(self::ATTR_CHANGE, $value);
    }

    /**
     * Returns value of 'attr_change' property
     *
     * @return \PB_AttributeChange
     */
    public function getAttrChange()
    {
        return $this->get(self::ATTR_CHANGE);
    }

    /**
     * Sets value of 'cfg_changed' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCfgChanged($value)
    {
        return $this->set(self::CFG_CHANGED, $value);
    }

    /**
     * Returns value of 'cfg_changed' property
     *
     * @return string
     */
    public function getCfgChanged()
    {
        $value = $this->get(self::CFG_CHANGED);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'cs_new_msg' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setCsNewMsg($value)
    {
        return $this->set(self::CS_NEW_MSG, $value);
    }

    /**
     * Returns value of 'cs_new_msg' property
     *
     * @return boolean
     */
    public function getCsNewMsg()
    {
        $value = $this->get(self::CS_NEW_MSG);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'little_game_update' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setLittleGameUpdate($value)
    {
        return $this->set(self::LITTLE_GAME_UPDATE, $value);
    }

    /**
     * Returns value of 'little_game_update' property
     *
     * @return boolean
     */
    public function getLittleGameUpdate()
    {
        $value = $this->get(self::LITTLE_GAME_UPDATE);
        return $value === null ? (boolean)$value : $value;
    }
}
}