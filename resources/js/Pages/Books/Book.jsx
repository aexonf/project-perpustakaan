import React, { useEffect, useState } from "react";
import { Button } from "@/Components/ui/button";
import { Label } from "@/Components/ui/label";
import { Input } from "@/Components/ui/input";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import { cn } from "@/lib/utils";
import {
    ChevronLeft,
    ChevronRight,
    ChevronsLeft,
    ChevronsRight,
} from "lucide-react";
import { useForm } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";
import NewBooks from "./NewBooks";

export default function Book({ books, latestBooks }) {
    const [selectedType, setSelectedType] = useState("title");
    const [currentPage, setCurrentPage] = useState(books?.current_page);
    const param = new URL(window.location).searchParams;
    const { data, setData, get, processing } = useForm({
        search: param.get("search") ?? "",
        type: "",
        page: "",
    });
    useEffect(() => {
        if (currentPage == books?.current_page) {
            return;
        }
        Inertia.get(
            "/books",
            {
                ...data,
                search: data.search,
                page: currentPage,
            },
            {
                preserveScroll: true,
                preserveState: true,
            }
        );
    }, [currentPage]);
    const handleSearch = (e) => {
        e.preventDefault();
        setCurrentPage(1);
        get("/books", {
            data: {
                ...data,
                page: currentPage,
            },
            preserveScroll: true,
            preserveState: true,
            onError: (e) => console.log(e),
        });
    };
    return (
        <div className="bg-white min-h-screen flex justify-center py-4 md:px-52">
            <div className="w-full space-y-8">
                <div className="flex flex-col justify-center w-full items-center">
                    <div className="flex items-center p-4">
                        <img
                            src="/img/logo_skanka.png"
                            alt="logo_skanka"
                            className="w-26 h-24 mr-2"
                        />
                        <h1 className="text-3xl font-extrabold text-center md:text-5xl">
                            SMK 1 KASREMAN
                        </h1>
                    </div>
                    <p className="text-center text-2xl text-[#828282] font-inter tracking-wide w-full mt-4">
                        Katalog Buku Online yang Terintegrasi pada Koleksi
                        Perpustakaan
                    </p>
                </div>
                <hr className="mt-6 w-full" />
                <div className="p-3">
                    <h1 className="text-3xl  font-bold text-center mb-3">
                        Pencarian Buku
                    </h1>
                    <div className="grid grid-cols-4 w-full justify-end gap-6">
                        <div className="col-span-full md:col-span-1 flex flex-col justify-end">
                            <Label
                                htmlFor="title"
                                className="text-2xl font-inter font-semibold"
                            >
                                Tipe Kunci
                            </Label>
                            <Select
                                defaultValue={selectedType}
                                id="title"
                                name="title"
                                onValueChange={(e) => {
                                    setSelectedType(e);
                                    setData("type", e);
                                }}
                            >
                                <SelectTrigger className="text-xl font-semibold h-full p-4 mt-4 border-[#BDBDBD]">
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent className="text-xl font-normal">
                                    <SelectItem
                                        className="text-xl font-normal"
                                        value="title"
                                    >
                                        Judul
                                    </SelectItem>
                                    <SelectItem
                                        className="text-xl font-normal"
                                        value="genre"
                                    >
                                        Genre
                                    </SelectItem>
                                    <SelectItem
                                        className="text-xl font-normal"
                                        value="year"
                                    >
                                        Tahun
                                    </SelectItem>
                                    <SelectItem
                                        className="text-xl font-normal"
                                        value="location"
                                    >
                                        Lokasi
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div className="col-span-full md:col-span-2 flex flex-col justify-end">
                            <Label
                                htmlFor="title"
                                className="text-2xl font-semibold"
                            >
                                Kata Kunci
                            </Label>
                            <Input
                                type="text"
                                defaultValue={data.search}
                                onChange={(e) =>
                                    setData({
                                        ...data,
                                        search: e.target.value,
                                    })
                                }
                                id="title"
                                name="title"
                                className="text-2xl px-4 py-3 mt-4 placeholder:text-[#A0A0A0] border-[#BDBDBD]"
                                placeholder="Ketik kata kunci pencarian"
                            />
                        </div>
                        <div className="col-span-full md:col-span-1  flex justify-end flex-col">
                            <Button
                                className="w-full bg-[#0B96F7] px-6 py-4 font-semibold tracking-wider text-xl rounded-xl"
                                onClick={handleSearch}
                            >
                                CARI
                            </Button>
                        </div>
                    </div>
                    <div className="relative overflow-x-auto w-full whitespace-nowrap break-keep md:mt-4 mt-8">
                        <Table>
                            <TableHeader
                                className={cn(
                                    "text-xs text-gray-700 uppercase bg-gray-50",
                                    books?.data?.length <= 0 ? "hidden" : ""
                                )}
                            >
                                <TableRow className="bg-[#00487B] text-white hover:bg-[#00487bea] text-xl ">
                                    <TableHead
                                        align="center"
                                        className="text-center  text-white py-5 font-semibold"
                                    >
                                        No
                                    </TableHead>
                                    <TableHead
                                        align="center"
                                        className="text-center  text-white py-5 font-semibold"
                                    >
                                        Buku
                                    </TableHead>
                                    <TableHead
                                        align="center"
                                        className="text-center  text-white py-5 font-semibold"
                                    >
                                        Lokasi
                                    </TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {books?.data?.length <= 0 && (
                                    <TableRow>
                                        <TableCell align="center" colSpan={3}>
                                            <div className="flex justify-center items-center">
                                                <div className="flex flex-col items-center">
                                                    <span className="text-3xl font-semibold">
                                                        Buku Tidak Ada
                                                    </span>
                                                </div>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                )}
                                {books?.data?.length > 0 &&
                                    books?.data?.map((book) => (
                                        <TableRow
                                            key={book.id}
                                            className="border-b"
                                        >
                                            <TableCell
                                                className="p-4 text-xl"
                                                align="center"
                                            >
                                                {book.no_inventory}
                                            </TableCell>
                                            <TableCell
                                                className="p-4 text-xl font-semibold"
                                                align="center"
                                            >
                                                {book.title}
                                            </TableCell>
                                            <TableCell
                                                className="p-4 text-xl"
                                                align="center"
                                            >
                                                {book.location}
                                            </TableCell>
                                        </TableRow>
                                    ))}
                            </TableBody>
                        </Table>
                        {books?.data?.length > 0 && books?.last_page > 1 && (
                            <div className="flex justify-center md:justify-end mt-3">
                                <div className="flex items-center justify-end mt-2 gap-x-1.5">
                                    <Button
                                        size="icon"
                                        disabled={
                                            currentPage == 1 || processing
                                        }
                                        onClick={() => setCurrentPage(1)}
                                    >
                                        <ChevronsLeft />
                                    </Button>
                                    <Button
                                        size="icon"
                                        disabled={
                                            currentPage == 1 || processing
                                        }
                                        onClick={() =>
                                            setCurrentPage(currentPage - 1)
                                        }
                                    >
                                        <ChevronLeft />
                                    </Button>
                                    <strong className="mx-4 select-none text-sm font-medium">
                                        {currentPage} / {books?.last_page}
                                    </strong>
                                    <Button
                                        size="icon"
                                        disabled={
                                            currentPage >= books?.last_page ||
                                            processing
                                        }
                                        onClick={() =>
                                            setCurrentPage(currentPage + 1)
                                        }
                                    >
                                        <ChevronRight />
                                    </Button>
                                    <Button
                                        size="icon"
                                        disabled={
                                            currentPage >= books?.last_page ||
                                            processing
                                        }
                                        onClick={() =>
                                            setCurrentPage(books?.last_page)
                                        }
                                    >
                                        <ChevronsRight />
                                    </Button>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
                <NewBooks data={latestBooks} />
            </div>
        </div>
    );
}
