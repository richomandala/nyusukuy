<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class inventaris
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.PictureBox1 = New System.Windows.Forms.PictureBox()
        Me.panel_topbar = New System.Windows.Forms.Panel()
        Me.btn_mini = New System.Windows.Forms.Button()
        Me.btn_exit = New System.Windows.Forms.Button()
        Me.panel_inventaris = New System.Windows.Forms.Panel()
        Me.data_inventaris = New System.Windows.Forms.DataGridView()
        Me.Button1 = New System.Windows.Forms.Button()
        Me.GroupBox1 = New System.Windows.Forms.GroupBox()
        Me.ubah_id = New System.Windows.Forms.TextBox()
        Me.ubah_jumlah = New System.Windows.Forms.NumericUpDown()
        Me.btn_hapus = New System.Windows.Forms.Button()
        Me.btn_ubah = New System.Windows.Forms.Button()
        Me.ubah_ket = New System.Windows.Forms.TextBox()
        Me.ubah_nama = New System.Windows.Forms.TextBox()
        Me.ubah_kode = New System.Windows.Forms.TextBox()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.panel_tambah_inventaris = New System.Windows.Forms.Panel()
        Me.btn_kembali = New System.Windows.Forms.Button()
        Me.GroupBox2 = New System.Windows.Forms.GroupBox()
        Me.btn_tambah = New System.Windows.Forms.Button()
        Me.tambah_jumlah = New System.Windows.Forms.NumericUpDown()
        Me.tambah_ket = New System.Windows.Forms.TextBox()
        Me.tambah_barang = New System.Windows.Forms.TextBox()
        Me.Label9 = New System.Windows.Forms.Label()
        Me.Label8 = New System.Windows.Forms.Label()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.Label1 = New System.Windows.Forms.Label()
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.panel_topbar.SuspendLayout()
        Me.panel_inventaris.SuspendLayout()
        CType(Me.data_inventaris, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.GroupBox1.SuspendLayout()
        CType(Me.ubah_jumlah, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.panel_tambah_inventaris.SuspendLayout()
        Me.GroupBox2.SuspendLayout()
        CType(Me.tambah_jumlah, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'PictureBox1
        '
        Me.PictureBox1.BackgroundImage = Global.nyusukuy.My.Resources.Resources.logo
        Me.PictureBox1.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Zoom
        Me.PictureBox1.Location = New System.Drawing.Point(0, 0)
        Me.PictureBox1.Name = "PictureBox1"
        Me.PictureBox1.Size = New System.Drawing.Size(71, 51)
        Me.PictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom
        Me.PictureBox1.TabIndex = 7
        Me.PictureBox1.TabStop = False
        '
        'panel_topbar
        '
        Me.panel_topbar.BackColor = System.Drawing.Color.Goldenrod
        Me.panel_topbar.Controls.Add(Me.Label1)
        Me.panel_topbar.Controls.Add(Me.btn_mini)
        Me.panel_topbar.Controls.Add(Me.PictureBox1)
        Me.panel_topbar.Controls.Add(Me.btn_exit)
        Me.panel_topbar.Dock = System.Windows.Forms.DockStyle.Top
        Me.panel_topbar.Location = New System.Drawing.Point(0, 0)
        Me.panel_topbar.Name = "panel_topbar"
        Me.panel_topbar.Size = New System.Drawing.Size(892, 50)
        Me.panel_topbar.TabIndex = 10
        '
        'btn_mini
        '
        Me.btn_mini.BackColor = System.Drawing.Color.Transparent
        Me.btn_mini.BackgroundImage = Global.nyusukuy.My.Resources.Resources.negative
        Me.btn_mini.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Zoom
        Me.btn_mini.Cursor = System.Windows.Forms.Cursors.Hand
        Me.btn_mini.FlatAppearance.BorderSize = 0
        Me.btn_mini.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.btn_mini.Location = New System.Drawing.Point(822, 9)
        Me.btn_mini.Name = "btn_mini"
        Me.btn_mini.Size = New System.Drawing.Size(27, 32)
        Me.btn_mini.TabIndex = 1
        Me.btn_mini.UseVisualStyleBackColor = False
        '
        'btn_exit
        '
        Me.btn_exit.BackColor = System.Drawing.Color.Transparent
        Me.btn_exit.BackgroundImage = Global.nyusukuy.My.Resources.Resources.logout
        Me.btn_exit.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Zoom
        Me.btn_exit.Cursor = System.Windows.Forms.Cursors.Hand
        Me.btn_exit.FlatAppearance.BorderSize = 0
        Me.btn_exit.FlatStyle = System.Windows.Forms.FlatStyle.Flat
        Me.btn_exit.Location = New System.Drawing.Point(855, 9)
        Me.btn_exit.Name = "btn_exit"
        Me.btn_exit.Size = New System.Drawing.Size(27, 32)
        Me.btn_exit.TabIndex = 0
        Me.btn_exit.UseVisualStyleBackColor = False
        '
        'panel_inventaris
        '
        Me.panel_inventaris.BackColor = System.Drawing.SystemColors.ActiveCaption
        Me.panel_inventaris.Controls.Add(Me.data_inventaris)
        Me.panel_inventaris.Controls.Add(Me.Button1)
        Me.panel_inventaris.Controls.Add(Me.GroupBox1)
        Me.panel_inventaris.Dock = System.Windows.Forms.DockStyle.Fill
        Me.panel_inventaris.Location = New System.Drawing.Point(0, 50)
        Me.panel_inventaris.Name = "panel_inventaris"
        Me.panel_inventaris.Size = New System.Drawing.Size(892, 413)
        Me.panel_inventaris.TabIndex = 11
        '
        'data_inventaris
        '
        Me.data_inventaris.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize
        Me.data_inventaris.Location = New System.Drawing.Point(7, 36)
        Me.data_inventaris.Name = "data_inventaris"
        Me.data_inventaris.Size = New System.Drawing.Size(681, 365)
        Me.data_inventaris.TabIndex = 3
        '
        'Button1
        '
        Me.Button1.Location = New System.Drawing.Point(7, 7)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(99, 23)
        Me.Button1.TabIndex = 0
        Me.Button1.Text = "Tambah"
        Me.Button1.UseVisualStyleBackColor = True
        '
        'GroupBox1
        '
        Me.GroupBox1.Controls.Add(Me.ubah_id)
        Me.GroupBox1.Controls.Add(Me.ubah_jumlah)
        Me.GroupBox1.Controls.Add(Me.btn_hapus)
        Me.GroupBox1.Controls.Add(Me.btn_ubah)
        Me.GroupBox1.Controls.Add(Me.ubah_ket)
        Me.GroupBox1.Controls.Add(Me.ubah_nama)
        Me.GroupBox1.Controls.Add(Me.ubah_kode)
        Me.GroupBox1.Controls.Add(Me.Label5)
        Me.GroupBox1.Controls.Add(Me.Label4)
        Me.GroupBox1.Controls.Add(Me.Label3)
        Me.GroupBox1.Controls.Add(Me.Label2)
        Me.GroupBox1.Location = New System.Drawing.Point(694, 31)
        Me.GroupBox1.Name = "GroupBox1"
        Me.GroupBox1.Size = New System.Drawing.Size(192, 370)
        Me.GroupBox1.TabIndex = 2
        Me.GroupBox1.TabStop = False
        Me.GroupBox1.Text = "Edit"
        '
        'ubah_id
        '
        Me.ubah_id.Location = New System.Drawing.Point(42, 6)
        Me.ubah_id.Name = "ubah_id"
        Me.ubah_id.ReadOnly = True
        Me.ubah_id.Size = New System.Drawing.Size(100, 20)
        Me.ubah_id.TabIndex = 14
        Me.ubah_id.Visible = False
        '
        'ubah_jumlah
        '
        Me.ubah_jumlah.Location = New System.Drawing.Point(9, 180)
        Me.ubah_jumlah.Maximum = New Decimal(New Integer() {1410065408, 2, 0, 0})
        Me.ubah_jumlah.Minimum = New Decimal(New Integer() {1, 0, 0, 0})
        Me.ubah_jumlah.Name = "ubah_jumlah"
        Me.ubah_jumlah.ReadOnly = True
        Me.ubah_jumlah.Size = New System.Drawing.Size(177, 20)
        Me.ubah_jumlah.TabIndex = 13
        Me.ubah_jumlah.ThousandsSeparator = True
        Me.ubah_jumlah.Value = New Decimal(New Integer() {1, 0, 0, 0})
        '
        'btn_hapus
        '
        Me.btn_hapus.Enabled = False
        Me.btn_hapus.Location = New System.Drawing.Point(90, 210)
        Me.btn_hapus.Name = "btn_hapus"
        Me.btn_hapus.Size = New System.Drawing.Size(75, 23)
        Me.btn_hapus.TabIndex = 12
        Me.btn_hapus.Text = "Hapus"
        Me.btn_hapus.UseVisualStyleBackColor = True
        '
        'btn_ubah
        '
        Me.btn_ubah.Enabled = False
        Me.btn_ubah.Location = New System.Drawing.Point(9, 210)
        Me.btn_ubah.Name = "btn_ubah"
        Me.btn_ubah.Size = New System.Drawing.Size(75, 23)
        Me.btn_ubah.TabIndex = 10
        Me.btn_ubah.Text = "Ubah"
        Me.btn_ubah.UseVisualStyleBackColor = True
        '
        'ubah_ket
        '
        Me.ubah_ket.Location = New System.Drawing.Point(9, 135)
        Me.ubah_ket.Name = "ubah_ket"
        Me.ubah_ket.ReadOnly = True
        Me.ubah_ket.Size = New System.Drawing.Size(177, 20)
        Me.ubah_ket.TabIndex = 7
        '
        'ubah_nama
        '
        Me.ubah_nama.Location = New System.Drawing.Point(9, 91)
        Me.ubah_nama.Name = "ubah_nama"
        Me.ubah_nama.ReadOnly = True
        Me.ubah_nama.Size = New System.Drawing.Size(177, 20)
        Me.ubah_nama.TabIndex = 6
        '
        'ubah_kode
        '
        Me.ubah_kode.Location = New System.Drawing.Point(9, 47)
        Me.ubah_kode.Name = "ubah_kode"
        Me.ubah_kode.ReadOnly = True
        Me.ubah_kode.Size = New System.Drawing.Size(177, 20)
        Me.ubah_kode.TabIndex = 5
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.Location = New System.Drawing.Point(6, 163)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(40, 13)
        Me.Label5.TabIndex = 3
        Me.Label5.Text = "Jumlah"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Location = New System.Drawing.Point(6, 119)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(62, 13)
        Me.Label4.TabIndex = 2
        Me.Label4.Text = "Keterangan"
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(6, 74)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(72, 13)
        Me.Label3.TabIndex = 1
        Me.Label3.Text = "Nama Barang"
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(6, 30)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(81, 13)
        Me.Label2.TabIndex = 0
        Me.Label2.Text = "Kode Inventaris"
        '
        'panel_tambah_inventaris
        '
        Me.panel_tambah_inventaris.BackColor = System.Drawing.SystemColors.ActiveCaption
        Me.panel_tambah_inventaris.Controls.Add(Me.btn_kembali)
        Me.panel_tambah_inventaris.Controls.Add(Me.GroupBox2)
        Me.panel_tambah_inventaris.Dock = System.Windows.Forms.DockStyle.Fill
        Me.panel_tambah_inventaris.Location = New System.Drawing.Point(0, 50)
        Me.panel_tambah_inventaris.Name = "panel_tambah_inventaris"
        Me.panel_tambah_inventaris.Size = New System.Drawing.Size(892, 413)
        Me.panel_tambah_inventaris.TabIndex = 12
        '
        'btn_kembali
        '
        Me.btn_kembali.Location = New System.Drawing.Point(9, 7)
        Me.btn_kembali.Name = "btn_kembali"
        Me.btn_kembali.Size = New System.Drawing.Size(75, 23)
        Me.btn_kembali.TabIndex = 1
        Me.btn_kembali.Text = "Kembali"
        Me.btn_kembali.UseVisualStyleBackColor = True
        '
        'GroupBox2
        '
        Me.GroupBox2.Controls.Add(Me.btn_tambah)
        Me.GroupBox2.Controls.Add(Me.tambah_jumlah)
        Me.GroupBox2.Controls.Add(Me.tambah_ket)
        Me.GroupBox2.Controls.Add(Me.tambah_barang)
        Me.GroupBox2.Controls.Add(Me.Label9)
        Me.GroupBox2.Controls.Add(Me.Label8)
        Me.GroupBox2.Controls.Add(Me.Label7)
        Me.GroupBox2.Location = New System.Drawing.Point(9, 38)
        Me.GroupBox2.Name = "GroupBox2"
        Me.GroupBox2.Size = New System.Drawing.Size(521, 205)
        Me.GroupBox2.TabIndex = 0
        Me.GroupBox2.TabStop = False
        Me.GroupBox2.Text = "Tambah Inventaris"
        '
        'btn_tambah
        '
        Me.btn_tambah.Location = New System.Drawing.Point(6, 168)
        Me.btn_tambah.Name = "btn_tambah"
        Me.btn_tambah.Size = New System.Drawing.Size(75, 24)
        Me.btn_tambah.TabIndex = 8
        Me.btn_tambah.Text = "Tambah"
        Me.btn_tambah.UseVisualStyleBackColor = True
        '
        'tambah_jumlah
        '
        Me.tambah_jumlah.Location = New System.Drawing.Point(7, 141)
        Me.tambah_jumlah.Maximum = New Decimal(New Integer() {100000000, 0, 0, 0})
        Me.tambah_jumlah.Minimum = New Decimal(New Integer() {1, 0, 0, 0})
        Me.tambah_jumlah.Name = "tambah_jumlah"
        Me.tambah_jumlah.Size = New System.Drawing.Size(508, 20)
        Me.tambah_jumlah.TabIndex = 7
        Me.tambah_jumlah.Value = New Decimal(New Integer() {1, 0, 0, 0})
        '
        'tambah_ket
        '
        Me.tambah_ket.Location = New System.Drawing.Point(7, 95)
        Me.tambah_ket.Name = "tambah_ket"
        Me.tambah_ket.Size = New System.Drawing.Size(508, 20)
        Me.tambah_ket.TabIndex = 6
        '
        'tambah_barang
        '
        Me.tambah_barang.Location = New System.Drawing.Point(7, 51)
        Me.tambah_barang.Name = "tambah_barang"
        Me.tambah_barang.Size = New System.Drawing.Size(508, 20)
        Me.tambah_barang.TabIndex = 5
        '
        'Label9
        '
        Me.Label9.AutoSize = True
        Me.Label9.Location = New System.Drawing.Point(6, 124)
        Me.Label9.Name = "Label9"
        Me.Label9.Size = New System.Drawing.Size(40, 13)
        Me.Label9.TabIndex = 2
        Me.Label9.Text = "Jumlah"
        '
        'Label8
        '
        Me.Label8.AutoSize = True
        Me.Label8.Location = New System.Drawing.Point(6, 80)
        Me.Label8.Name = "Label8"
        Me.Label8.Size = New System.Drawing.Size(62, 13)
        Me.Label8.TabIndex = 1
        Me.Label8.Text = "Keterangan"
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.Location = New System.Drawing.Point(7, 34)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(72, 13)
        Me.Label7.TabIndex = 0
        Me.Label7.Text = "Nama Barang"
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Font = New System.Drawing.Font("Comic Sans MS", 14.25!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label1.ForeColor = System.Drawing.Color.White
        Me.Label1.Location = New System.Drawing.Point(77, 12)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(98, 27)
        Me.Label1.TabIndex = 8
        Me.Label1.Text = "Nyusukuy"
        '
        'inventaris
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(892, 463)
        Me.Controls.Add(Me.panel_inventaris)
        Me.Controls.Add(Me.panel_tambah_inventaris)
        Me.Controls.Add(Me.panel_topbar)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Name = "inventaris"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "inventaris"
        CType(Me.PictureBox1, System.ComponentModel.ISupportInitialize).EndInit()
        Me.panel_topbar.ResumeLayout(False)
        Me.panel_topbar.PerformLayout()
        Me.panel_inventaris.ResumeLayout(False)
        CType(Me.data_inventaris, System.ComponentModel.ISupportInitialize).EndInit()
        Me.GroupBox1.ResumeLayout(False)
        Me.GroupBox1.PerformLayout()
        CType(Me.ubah_jumlah, System.ComponentModel.ISupportInitialize).EndInit()
        Me.panel_tambah_inventaris.ResumeLayout(False)
        Me.GroupBox2.ResumeLayout(False)
        Me.GroupBox2.PerformLayout()
        CType(Me.tambah_jumlah, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents PictureBox1 As System.Windows.Forms.PictureBox
    Friend WithEvents panel_topbar As System.Windows.Forms.Panel
    Friend WithEvents btn_mini As System.Windows.Forms.Button
    Friend WithEvents btn_exit As System.Windows.Forms.Button
    Friend WithEvents panel_inventaris As System.Windows.Forms.Panel
    Friend WithEvents Button1 As System.Windows.Forms.Button
    Friend WithEvents GroupBox1 As System.Windows.Forms.GroupBox
    Friend WithEvents btn_hapus As System.Windows.Forms.Button
    Friend WithEvents btn_ubah As System.Windows.Forms.Button
    Friend WithEvents ubah_ket As System.Windows.Forms.TextBox
    Friend WithEvents ubah_nama As System.Windows.Forms.TextBox
    Friend WithEvents ubah_kode As System.Windows.Forms.TextBox
    Friend WithEvents Label5 As System.Windows.Forms.Label
    Friend WithEvents Label4 As System.Windows.Forms.Label
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents ubah_jumlah As System.Windows.Forms.NumericUpDown
    Friend WithEvents ubah_id As System.Windows.Forms.TextBox
    Friend WithEvents data_inventaris As System.Windows.Forms.DataGridView
    Friend WithEvents panel_tambah_inventaris As System.Windows.Forms.Panel
    Friend WithEvents btn_kembali As System.Windows.Forms.Button
    Friend WithEvents GroupBox2 As System.Windows.Forms.GroupBox
    Friend WithEvents tambah_ket As System.Windows.Forms.TextBox
    Friend WithEvents tambah_barang As System.Windows.Forms.TextBox
    Friend WithEvents Label9 As System.Windows.Forms.Label
    Friend WithEvents Label8 As System.Windows.Forms.Label
    Friend WithEvents Label7 As System.Windows.Forms.Label
    Friend WithEvents btn_tambah As System.Windows.Forms.Button
    Friend WithEvents tambah_jumlah As System.Windows.Forms.NumericUpDown
    Friend WithEvents Label1 As System.Windows.Forms.Label
End Class
