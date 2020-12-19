Imports System.Net
Imports System.IO
Imports System.Text
Imports Newtonsoft.Json
Imports Newtonsoft.Json.Linq

Public Class inventaris

    Protected url As String = "http://localhost:8080/api/"

    'Ini Button Minimize

    Private Sub btn_mini_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btn_mini.Click
        Me.WindowState = FormWindowState.Minimized
    End Sub

    'Akhir button minimize

    'Ini button exit

    Private Sub btn_exit_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btn_exit.Click
        Me.Close()
    End Sub

    'Akhir button exit

    Private Sub Form_Inventaris_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        panel_inventaris.Show()
        panel_tambah_inventaris.Hide()
        dataInventarisLoad()
        clear()
    End Sub

    Sub clear()
        ubah_id.Clear()
        ubah_kode.Clear()
        ubah_nama.Clear()
        ubah_ket.Clear()
        ubah_jumlah.Value = 1
        btn_ubah.Enabled = False
        btn_hapus.Enabled = False
    End Sub

    Sub clearPanelTambah()
        tambah_barang.Clear()
        tambah_ket.Clear()
        tambah_jumlah.Value = 1
    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        panel_inventaris.Hide()
        panel_tambah_inventaris.Show()
        clearPanelTambah()
    End Sub

    Private Sub menu_inventaris_Click(ByVal sender As System.Object, ByVal e As System.EventArgs)
        panel_inventaris.Show()
        panel_tambah_inventaris.Hide()
        clear()
        dataInventarisLoad()
    End Sub

    Private Sub btn_kembali_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btn_kembali.Click
        panel_inventaris.Show()
        panel_tambah_inventaris.Hide()
        clear()
        dataInventarisLoad()
    End Sub

    Sub dataInventarisLoad()
        Try
            Dim judul() As String = {"id", "No", "Kode inventaris", "Nama barang", "Keterangan", "Jumlah"}
            Dim lebar() As String = {0, 50, 140, 250, 168, 70}
            Dim i As Integer
            data_inventaris.RowHeadersVisible = False
            data_inventaris.ColumnCount = 6
            data_inventaris.RowCount = 1
            data_inventaris.SelectionMode = DataGridViewSelectionMode.CellSelect
            data_inventaris.ColumnHeadersDefaultCellStyle.Font = New Font("Arial", 12)

            For i = 0 To data_inventaris.ColumnCount - 1
                data_inventaris.Columns(i).HeaderText = judul(i)
                data_inventaris.Columns(i).Width = lebar(i)
                data_inventaris.Columns(i).DefaultCellStyle.Font = New Font("Arial", 10)
                data_inventaris.Columns(i).DefaultCellStyle.BackColor = Color.AliceBlue
            Next
            data_inventaris.Columns(0).Visible = False
            Dim request As WebRequest = WebRequest.Create(url & "inventaris")
            request.Method = "GET"
            Dim response As WebResponse = request.GetResponse()
            Dim dataStream As Stream = response.GetResponseStream()
            Dim reader As New StreamReader(dataStream)
            Dim responseFromServer As String = reader.ReadToEnd()
            dataStream.Close()
            Dim myObject As JObject = JsonConvert.DeserializeObject(responseFromServer)
            If myObject("status") = "True" Then
                Dim myArray As JArray = myObject("data")
                Dim jumlah As Integer = myArray.Count
                For x As Integer = 0 To jumlah - 1
                    data_inventaris.Rows.Add(myArray(x)("id"), x + 1, myArray(x)("kode_inventaris"), myArray(x)("barang"), myArray(x)("keterangan"), myArray(x)("jumlah"))
                Next
            End If
        Catch ex As Exception
            MsgBox(ex.Message, MsgBoxStyle.Information, "Gagal")
        End Try

    End Sub

    Private Sub data_inventaris_CellClick(ByVal sender As Object, ByVal e As System.Windows.Forms.DataGridViewCellEventArgs) Handles data_inventaris.CellClick
        clear()
        ubah_id.Text = data_inventaris.Rows.Item(e.RowIndex).Cells(0).Value.ToString
        ubah_kode.Text = data_inventaris.Rows.Item(e.RowIndex).Cells(2).Value.ToString
        ubah_nama.ReadOnly = False
        ubah_nama.Text = data_inventaris.Rows.Item(e.RowIndex).Cells(3).Value.ToString
        ubah_ket.ReadOnly = False
        ubah_ket.Text = data_inventaris.Rows.Item(e.RowIndex).Cells(4).Value.ToString
        ubah_jumlah.ReadOnly = False
        ubah_jumlah.Value = data_inventaris.Rows.Item(e.RowIndex).Cells(5).Value.ToString
        btn_ubah.Enabled = True
        btn_hapus.Enabled = True
    End Sub


    Private Sub btn_ubah_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btn_ubah.Click
        If (ubah_nama.Text = "" Or ubah_ket.Text = "" Or ubah_jumlah.Value < 1) Then
            MsgBox("Isi seluruh input terlebih dahulu!")
        Else
            Try
                Dim request As WebRequest = WebRequest.Create(url & "inventaris")
                request.Method = "PUT"
                Dim postData = "id=" & ubah_id.Text & "&barang=" & ubah_nama.Text & "&keterangan=" & ubah_ket.Text & "&jumlah=" & ubah_jumlah.Value
                Dim byteArray As Byte() = Encoding.UTF8.GetBytes(postData)
                request.ContentType = "application/x-www-form-urlencoded"
                request.ContentLength = byteArray.Length
                Dim dataStream As Stream = request.GetRequestStream()
                dataStream.Write(byteArray, 0, byteArray.Length)
                dataStream.Close()
                Dim response As WebResponse = request.GetResponse()
                dataStream = response.GetResponseStream()
                Dim reader As New StreamReader(dataStream)
                Dim responseFromServer As String = reader.ReadToEnd()
                dataStream.Close()
                Dim myObject As JObject = JsonConvert.DeserializeObject(responseFromServer)
                MsgBox(myObject("message").ToString, MsgBoxStyle.Information, "Sukses")
                clear()
                dataInventarisLoad()
            Catch ex As Exception
                MsgBox(ex.Message, MsgBoxStyle.Information, "Gagal")
                clear()
                dataInventarisLoad()
            End Try
        End If
    End Sub

    Private Sub btn_hapus_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btn_hapus.Click
        Try
            Dim request As WebRequest = WebRequest.Create(url & "inventaris/" & ubah_id.Text)
            request.Method = "DELETE"
            Dim response As WebResponse = request.GetResponse()
            Dim dataStream As Stream = response.GetResponseStream()
            Dim reader As New StreamReader(dataStream)
            Dim responseFromServer As String = reader.ReadToEnd()
            dataStream.Close()
            Dim myObject As JObject = JsonConvert.DeserializeObject(responseFromServer)
            MsgBox(myObject("message").ToString, MsgBoxStyle.Information, "Sukses")
            clear()
            dataInventarisLoad()
        Catch ex As Exception
            MsgBox(ex.Message, MsgBoxStyle.Information, "Gagal")
            clear()
        End Try
    End Sub

    Private Sub btn_tambah_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btn_tambah.Click
        Try
            Dim request As WebRequest = WebRequest.Create(url & "inventaris")
            request.Method = "POST"
            Dim postData = "barang=" & tambah_barang.Text & "&keterangan=" & tambah_ket.Text & "&jumlah=" & tambah_jumlah.Value
            Dim byteArray As Byte() = Encoding.UTF8.GetBytes(postData)
            request.ContentType = "application/x-www-form-urlencoded"
            request.ContentLength = byteArray.Length
            Dim dataStream As Stream = request.GetRequestStream()
            dataStream.Write(byteArray, 0, byteArray.Length)
            dataStream.Close()
            Dim response As WebResponse = request.GetResponse()
            dataStream = response.GetResponseStream()
            Dim reader As New StreamReader(dataStream)
            Dim responseFromServer As String = reader.ReadToEnd()
            dataStream.Close()
            Dim myObject As JObject = JsonConvert.DeserializeObject(responseFromServer)
            MsgBox(myObject("message").ToString, MsgBoxStyle.Information, "Sukses")
            clearPanelTambah()
        Catch ex As Exception
            MsgBox(ex.Message, MsgBoxStyle.Information, "Gagal")
            clearPanelTambah()
        End Try
    End Sub
End Class