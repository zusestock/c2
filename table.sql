CREATE TABLE IF NOT EXISTS MoneyAccount(
     accountId int primary key auto_increment,
     dealPassword varchar(40) not null,
     withDrawPassword varchar(40) not null,
     nationalId  int not null,
     moneyLeft  double not null,
     createTime timestamp,
     accountState char not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS StockAccount(
     accountId int primary key auto_increment,
     password varchar(40) not null,
     accountState char not null,
     createTime timestamp,
     nationalId  int not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS PersonInfo(
     nationalId int primary key
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS StockMoneyRel(
     moneyAccountId int not null,
     stockAccountId int not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS StockInAccount(
     stockAccountId int not null,
     stockId varchar(40) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS StockInfo(
     stockId varchar(40) primary key not null,
     stockName varchar(40) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

alter table MoneyAccount add CONSTRAINT fk_nation_id_money_account
FOREIGN key (nationalId) REFERENCES PersonInfo(nationalId);

alter table StockAccount add CONSTRAINT fk_nation_id_stock_account
FOREIGN key (nationalId) REFERENCES PersonInfo(nationalId);

alter table StockMoneyRel add CONSTRAINT fk_money_account_id_stock_money_rel
FOREIGN key (moneyAccountId) REFERENCES MoneyAccount(accountId);

alter table StockMoneyRel add CONSTRAINT fk_stock_account_id_stock_money_rel
FOREIGN key (stockAccountId) REFERENCES StockAccount(accountId);

alter table StockInAccount add CONSTRAINT fk_stock_account_id_stock_in_account
FOREIGN key (stockAccountId) REFERENCES StockAccount(accountId);

alter table StockInAccount add CONSTRAINT fk_stock_id_stock_in_account
FOREIGN key (stockId) REFERENCES StockInfo(stockId);

