import React, { useState, useEffect } from "react";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Button } from "@/Components/ui/button";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import { Separator } from "@/Components/ui/separator";
import BookTable from "./BookTable";
import NewBooks from "./NewBooks";
import InfoBook from "./InfoBook";
import { useForm } from "@inertiajs/inertia-react";
import { Inertia } from "@inertiajs/inertia";

export default function Home({ books, latestBooks }) {
    const [isOpenInfo, setIsOpenInfo] = useState(false);
    const [selectedBook, setSelectedBook] = useState(null);
    const [selectedType, setSelectedType] = useState("title");
    const [search, setSearch] = useState("");
    const [currentPage, setCurrentPage] = useState(books?.current_page);
    const { data, setData, get, processing } = useForm({
        search: "",
        type: "",
        page: "",
    });
    useEffect(() => {
        setData({
            type: selectedType,
            search: search,
            page: 1,
        });
    }, [selectedType, search]);
    useEffect(() => {
        Inertia.get(
            "/",
            {
                ...data,
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
        get("/", {
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
        <div className="bg-muted ">
            <div className="relative w-full h-[100px] md:h-[150px] flex items-center">
                <div
                    className="absolute inset-0 bg-cover bg-center brightness-50"
                    style={{ backgroundImage: "url('img/book.jpg')" }}
                ></div>
                <div className="relative text-white container mx-auto z-10 flex items-center space-x-5">
                    <img src="img/logo_skanka.png" alt="logo_skanka" className="w-auto h-20 md:h-full" />
                    <div className="space-y-3">
                        <h1 className="text-2xl md:text-5xl font-bold">SMK 1 KASREMAN</h1>
                        <p className="text-base md:text-xl">
                            Katalog Buku Online yang Terintegrasi pada Koleksi
                            Perpustakaan.
                        </p>
                    </div>
                </div>
            </div>
            <div className="w-full p-9">
                <div className="grid grid-cols-6 gap-10">
                    <div className="col-span-6 md:col-span-4 bg-white p-5 rounded-lg min-h-full max-h-full">
                        <h3 className="text-2xl font-bold">Pencarian Buku</h3>
                        <div className="grid grid-cols-8 gap-x-5 my-5 space-y-1">
                            <div className="col-span-2">
                                <Label className="font-semibold text-base">
                                    Type Kunci
                                </Label>
                            </div>
                            <div className="col-span-6">
                                <Label
                                    className="font-semibold text-base"
                                    htmlFor="kata_kunci"
                                >
                                    Kata Kunci
                                </Label>
                            </div>
                            <div className="col-span-2 h-12">
                                <Select
                                    defaultValue={selectedType}
                                    onValueChange={setSelectedType}
                                >
                                    <SelectTrigger className="h-full">
                                        <SelectValue />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="title">
                                            Judul
                                        </SelectItem>
                                        <SelectItem value="genre">
                                            Genre
                                        </SelectItem>
                                        <SelectItem value="year">
                                            Tahun
                                        </SelectItem>
                                        <SelectItem value="location">
                                            Lokasi
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <div className="col-span-4">
                                <Input
                                    name="kata_kunci"
                                    id="kata_kunci"
                                    type="text"
                                    placeholder="Ketikkan Pencarian"
                                    className="border-2 w-full h-full"
                                    value={data?.search}
                                    onChange={(e) => {
                                        setSearch(e.target.value);
                                        setIsOpenInfo(false);
                                        setSelectedBook(null);
                                    }}
                                />
                            </div>
                            <div className="col-span-2">
                                <Button
                                    className="w-full h-full text-base md:text-lg font-semibold tracking-widest"
                                    onClick={handleSearch}
                                    disabled={processing}
                                >
                                    Cari
                                </Button>
                            </div>
                        </div>
                        <Separator className="my-4" />
                        <div className="w-full">
                            <BookTable
                                setOpenInfo={setIsOpenInfo}
                                openInfo={isOpenInfo}
                                data={books}
                                setSelectedBook={setSelectedBook}
                                selectedType={selectedType}
                                search={data?.search}
                                currentPage={currentPage}
                                setCurrentPage={setCurrentPage}
                                processing={processing}
                            />
                        </div>
                    </div>
                    <div className="col-span-6 md:col-span-2 bg-white rounded-lg">
                        {isOpenInfo ? (
                            <InfoBook
                                setIsOpenInfo={setIsOpenInfo}
                                book={selectedBook}
                                setSelectedBook={setSelectedBook}
                            />
                        ) : (
                            <NewBooks
                                data={latestBooks}
                                setIsOpenInfo={setIsOpenInfo}
                                setSelectedBook={setSelectedBook}
                            />
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
}
