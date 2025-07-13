<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../register_logic.php';

class RegisterTest extends TestCase
{
    public function testRegisterUserWithEmptyFields()
    {
        $mockDb = $this->createMock(mysqli::class);
        $result = register_user($mockDb, '', '', '', '');
        $this->assertEquals("Semua field harus diisi: nama, email, no_hp, dan password", $result);
    }

    public function testRegisterUserWithExistingEmail()
    {
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('store_result')->willReturn(null);
        $mockStmt->method('__get')->willReturn(1);

        $mockDb = $this->createMock(mysqli::class);
        $mockDb->method('prepare')->willReturn($mockStmt);

        $mockStmt->num_rows = 1;

        $result = register_user($mockDb, 'John', 'john@example.com', '08123456789', 'pass123');
        $this->assertEquals("Email sudah terdaftar", $result);
    }

    public function testRegisterUserSuccessfully()
    {
        $checkStmt = $this->createMock(mysqli_stmt::class);
        $checkStmt->method('execute')->willReturn(true);
        $checkStmt->method('store_result')->willReturn(null);
        $checkStmt->num_rows = 0;

        $insertStmt = $this->createMock(mysqli_stmt::class);
        $insertStmt->method('execute')->willReturn(true);

        $mockDb = $this->createMock(mysqli::class);
        $mockDb->expects($this->exactly(2))
               ->method('prepare')
               ->willReturnOnConsecutiveCalls($checkStmt, $insertStmt);

        $result = register_user($mockDb, 'John', 'john@example.com', '08123456789', 'pass123');
        $this->assertEquals("Pendaftaran berhasil!", $result);
    }
}
