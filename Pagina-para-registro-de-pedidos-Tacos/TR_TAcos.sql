Use BDTACOS
-- Trigger generar_IdMesa
CREATE TRIGGER generar_IdMesa
ON Mesa
AFTER INSERT
AS
BEGIN
    DECLARE @maxId INT;
    SET @maxId = (SELECT MAX(CAST(SUBSTRING(IdMesa, 2, LEN(IdMesa) - 1) AS INT)) FROM Mesa);
    SET @maxId = ISNULL(@maxId, 0);
    SET IDENTITY_INSERT Mesa ON;
    UPDATE Mesa SET IdMesa = CONCAT('M', RIGHT('000000000' + CAST(@maxId + 1 AS VARCHAR(10)), 10)) WHERE IdMesa IS NULL;
    SET IDENTITY_INSERT Mesa OFF;
END;
GO

-- Trigger generar_IdCliente
CREATE TRIGGER generar_IdCliente
ON Cliente
AFTER INSERT
AS
BEGIN
    DECLARE @maxId INT;
    SET @maxId = (SELECT MAX(CAST(SUBSTRING(IdCliente, 2, LEN(IdCliente) - 1) AS INT)) FROM Cliente);
    SET @maxId = ISNULL(@maxId, 0);
    SET IDENTITY_INSERT Cliente ON;
    UPDATE Cliente SET IdCliente = CONCAT('C', RIGHT('000000000' + CAST(@maxId + 1 AS VARCHAR(10)), 10)) WHERE IdCliente IS NULL;
    SET IDENTITY_INSERT Cliente OFF;
END;
GO

-- Trigger generar_IdUsuario
CREATE TRIGGER generar_IdUsuario
ON Usuario
AFTER INSERT
AS
BEGIN
    DECLARE @maxId INT;
    SET @maxId = (SELECT MAX(CAST(SUBSTRING(IdUsuario, 2, LEN(IdUsuario) - 1) AS INT)) FROM Usuario);
    SET @maxId = ISNULL(@maxId, 0);
    SET IDENTITY_INSERT Usuario ON;
    UPDATE Usuario SET IdUsuario = CONCAT('U', RIGHT('000000000' + CAST(@maxId + 1 AS VARCHAR(10)), 10)) WHERE IdUsuario IS NULL;
    SET IDENTITY_INSERT Usuario OFF;
END;
GO

-- Trigger actualizar_fecha_trigger
CREATE TRIGGER actualizar_fecha_trigger
ON Pedido
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;
    UPDATE Pedido SET FechaHora = GETDATE() WHERE IdPedido IN (SELECT IdPedido FROM inserted);
END;
GO

-- Trigger generar_IdPedido
CREATE TRIGGER generar_IdPedido
ON Pedido
AFTER INSERT
AS
BEGIN
    DECLARE @maxId INT;
    SET @maxId = (SELECT MAX(CAST(SUBSTRING(IdPedido, 2, LEN(IdPedido) - 1) AS INT)) FROM Pedido);
    SET @maxId = ISNULL(@maxId, 0);
    SET IDENTITY_INSERT Pedido ON;
    UPDATE Pedido SET IdPedido = CONCAT('P', RIGHT('000000000' + CAST(@maxId + 1 AS VARCHAR(10)), 10)) WHERE IdPedido IS NULL;
    SET IDENTITY_INSERT Pedido OFF;
END;
GO

-- Trigger nuevo_pedido_trigger
CREATE TRIGGER nuevo_pedido_trigger
ON Pedido
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;
    UPDATE Pedido SET Estado = 'EN ESPERA' WHERE IdPedido IN (SELECT IdPedido FROM inserted);
END;
GO


-- Trigger generar_IdCategoria
CREATE TRIGGER generar_IdCategoria
ON Categoria
AFTER INSERT
AS
BEGIN
    DECLARE @ultimo_id INT;
    DECLARE @nuevo_id VARCHAR(11);
    
    SELECT @ultimo_id = CAST(SUBSTRING(IdCategoria, 4, LEN(IdCategoria) - 3) AS INT) FROM Categoria ORDER BY IdCategoria DESC;
    SET @ultimo_id = ISNULL(@ultimo_id, 0);
    
    IF @ultimo_id = 0
        SET @nuevo_id = 'CAT001';
    ELSE
        SET @nuevo_id = CONCAT('CAT', RIGHT('000' + CAST(@ultimo_id + 1 AS VARCHAR(3)), 3));
    
    UPDATE Categoria SET IdCategoria = @nuevo_id WHERE IdCategoria IS NULL;
END;
GO

-- Trigger generar_IdConsumible
CREATE TRIGGER generar_IdConsumible
ON Consumible
AFTER INSERT
AS
BEGIN
    DECLARE @ultimo_id INT;
    DECLARE @nuevo_id VARCHAR(11);
    
    SELECT @ultimo_id = CAST(SUBSTRING(IdConsumible, 6, LEN(IdConsumible) - 5) AS INT) FROM Consumible WHERE SUBSTRING(IdConsumible, 1, 5) = 'Consu' ORDER BY CAST(SUBSTRING(IdConsumible, 6, LEN(IdConsumible) - 5) AS INT) DESC;
    SET @ultimo_id = ISNULL(@ultimo_id, 0);
    
    IF @ultimo_id = 0
        SET @nuevo_id = 'Consu001';
    ELSE
        SET @nuevo_id = CONCAT('Consu', RIGHT('000' + CAST(@ultimo_id + 1 AS VARCHAR(3)), 3));
    
    UPDATE Consumible SET IdConsumible = @nuevo_id WHERE IdConsumible IS NULL;
END;
GO

-- Trigger actualizar_precio_trigger
CREATE TRIGGER actualizar_precio_trigger
ON DetallePedido
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE dp
    SET dp.PrecioUnitario = c.PrecioUnitario
    FROM DetallePedido dp
    INNER JOIN Consumible c ON c.IdConsumible = dp.IdConsumible
    INNER JOIN inserted i ON i.IdDetallePedido = dp.IdDetallePedido;
END;
GO


-- Trigger actualizar_totalventa_trigger
CREATE TRIGGER actualizar_totalventa_trigger
ON DetallePedido
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;
    
    UPDATE p
    SET p.TotalVenta = (SELECT SUM(dp.Cantidad * dp.PrecioUnitario) FROM DetallePedido dp WHERE dp.IdPedido = i.IdPedido)
    FROM Pedido p
    INNER JOIN inserted i ON i.IdPedido = p.IdPedido;
END;
GO


-- Trigger generar_IdDetallePedido
CREATE TRIGGER generar_IdDetallePedido
ON DetallePedido
AFTER INSERT
AS
BEGIN
    DECLARE @maxId INT;
    SET @maxId = (SELECT MAX(CAST(SUBSTRING(IdDetallePedido, 3, 10) AS INT)) FROM DetallePedido);
    
    IF @maxId IS NULL
        SET @maxId = 0;
    
    UPDATE DetallePedido
    SET IdDetallePedido = CONCAT('DP', RIGHT('0000000000' + CAST(@maxId + 1 AS VARCHAR(10)), 10))
    WHERE IdDetallePedido IN (SELECT IdDetallePedido FROM inserted);
END;