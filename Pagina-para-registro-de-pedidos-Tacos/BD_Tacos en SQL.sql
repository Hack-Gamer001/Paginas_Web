IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'BDTACOS')
BEGIN
    CREATE DATABASE BDTACOS;
END
GO

-- Use database BDTACOS
USE BDTACOS;
GO


-- Table Mesa
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Mesa')
BEGIN
    CREATE TABLE Mesa (
      IdMesa VARCHAR(11) NOT NULL,
      Nivel INT NULL DEFAULT NULL,
      PRIMARY KEY (IdMesa)
    );
END
GO

-- Table Cliente
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Cliente')
BEGIN
    CREATE TABLE Cliente (
      IdCliente VARCHAR(11) NOT NULL,
      Nombre VARCHAR(50) NULL DEFAULT NULL,
      TipoDocumento VARCHAR(20) NULL DEFAULT NULL,
      NumDocumento VARCHAR(15) NULL DEFAULT NULL,
      PRIMARY KEY (IdCliente)
    );
END
GO

-- Table Usuario
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Usuario')
BEGIN
    CREATE TABLE Usuario (
      IdUsuario VARCHAR(11) NOT NULL,
      Nombre VARCHAR(50) NULL DEFAULT NULL,
      TipoDocumento VARCHAR(20) NULL DEFAULT NULL,
      NumDocumento VARCHAR(15) NULL DEFAULT NULL,
      Direccion VARCHAR(50) NULL DEFAULT NULL,
      Telefono VARCHAR(10) NULL DEFAULT NULL,
      Email VARCHAR(20) NULL DEFAULT NULL,
      Cargo VARCHAR(20) NULL DEFAULT NULL,
      Login VARCHAR(50) NULL DEFAULT NULL,
      Clave VARCHAR(50) NULL DEFAULT NULL,
      Imagen VARCHAR(50) NULL DEFAULT NULL,
      PRIMARY KEY (IdUsuario)
    );
END
GO

-- Table Pedido
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Pedido')
BEGIN
    CREATE TABLE Pedido (
      IdPedido VARCHAR(11) NOT NULL,
      IdMesa VARCHAR(11) NULL DEFAULT NULL,
      IdCliente VARCHAR(11) NULL DEFAULT NULL,
      IdUsuario VARCHAR(11) NULL DEFAULT NULL,
      Estado VARCHAR(11) NULL DEFAULT NULL,
      FechaHora DATETIME NULL DEFAULT NULL,
      TotalVenta DECIMAL(10, 0) NULL DEFAULT NULL,
      PRIMARY KEY (IdPedido),
      FOREIGN KEY (IdMesa)
        REFERENCES Mesa (IdMesa)
        ON DELETE CASCADE,
      FOREIGN KEY (IdCliente)
        REFERENCES Cliente (IdCliente)
        ON DELETE CASCADE,
      FOREIGN KEY (IdUsuario)
        REFERENCES Usuario (IdUsuario)
        ON DELETE CASCADE
    );
END
GO

-- Table Boleta
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Boleta')
BEGIN
    CREATE TABLE Boleta (
      IdBoleta VARCHAR(11) NOT NULL,
      IdPedido VARCHAR(11) NULL DEFAULT NULL,
      Estado VARCHAR(20) NULL DEFAULT NULL,
      FechaHora DATETIME NULL DEFAULT NULL,
      PRIMARY KEY (IdBoleta),
      FOREIGN KEY (IdPedido)
        REFERENCES Pedido (IdPedido)
        ON DELETE CASCADE
    );
END
GO

-- Table Categoria
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Categoria')
BEGIN
    CREATE TABLE Categoria (
      IdCategoria VARCHAR(11) NOT NULL,
      Nombre VARCHAR(50) NULL DEFAULT NULL,
      Descripcion VARCHAR(50) NULL DEFAULT NULL,
      PRIMARY KEY (IdCategoria)
    );
END
GO

-- Table Consumible
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'Consumible')
BEGIN
    CREATE TABLE Consumible (
      IdConsumible VARCHAR(11) NOT NULL,
      IdCategoria VARCHAR(11) NULL DEFAULT NULL,
      Nombre VARCHAR(20) NULL DEFAULT NULL,
      Descripcion VARCHAR(500) NULL DEFAULT NULL,
      Imagen VARCHAR(100) NULL DEFAULT NULL,
      PrecioUnitario DECIMAL(10, 0) NULL DEFAULT NULL,
      PRIMARY KEY (IdConsumible),
      FOREIGN KEY (IdCategoria)
        REFERENCES Categoria (IdCategoria)
    );
END
GO

-- Table DetallePedido
IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'DetallePedido')
BEGIN
    CREATE TABLE DetallePedido (
      IdDetallePedido VARCHAR(11) NOT NULL,
      IdPedido VARCHAR(11) NULL DEFAULT NULL,
      IdConsumible VARCHAR(11) NULL DEFAULT NULL,
      Cantidad INT NULL DEFAULT NULL,
      PrecioUnitario DECIMAL(10, 0) NULL DEFAULT NULL,
      PRIMARY KEY (IdDetallePedido),
      FOREIGN KEY (IdPedido)
        REFERENCES Pedido (IdPedido)
        ON DELETE CASCADE,
      FOREIGN KEY (IdConsumible)
        REFERENCES Consumible (IdConsumible)
        ON DELETE CASCADE
    );
END
GO
