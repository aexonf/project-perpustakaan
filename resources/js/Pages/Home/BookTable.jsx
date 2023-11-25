import React from "react";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import {
    ChevronLeft,
    ChevronRight,
    ChevronsLeft,
    ChevronsRight,
} from "lucide-react";

export default function BookTable({
    setOpenInfo,
    data,
    setSelectedBook,
    currentPage,
    setCurrentPage,
    processing,
}) {
    return (
        <>
            {data.length == 0 ? (
                <p>no data</p>
            ) : (
                <>
                    <Table className="border border-black">
                        <TableHeader>
                            <TableRow className="border border-black bg-primary hover:bg-primary">
                                <TableHead className="border border-black text-white font-semibold w-[25px] text-center">
                                    No
                                </TableHead>
                                <TableHead className="border border-black text-white font-semibold">
                                    Buku
                                </TableHead>
                                <TableHead className="border border-black text-white font-semibold text-start w-[100px]">
                                    Lokasi
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {data?.data?.length == 0 ? (
                                <TableRow className="border border-black">
                                    <TableCell
                                        align="center"
                                        colSpan={3}
                                        className="font-semibold"
                                    >
                                        Tidak ada data
                                    </TableCell>
                                </TableRow>
                            ) : (
                                data?.data?.map((book, i) => (
                                    <TableRow
                                        className="border border-black"
                                        key={book?.id}
                                    >
                                        <TableCell className="border border-black font-semibold text-center">
                                            {data?.from + i}
                                        </TableCell>
                                        <TableCell className="flex justify-between ">
                                            <div>
                                                <h5
                                                    className="text-lg text-primary font-bold cursor-pointer break-all max-w-prose truncate"
                                                    onClick={() => {
                                                        setOpenInfo(true);
                                                        setSelectedBook(book);
                                                    }}
                                                >
                                                    {book?.title}
                                                </h5>
                                                <p>
                                                    Penulis :{" "}
                                                    <b>{book?.writer}</b>
                                                </p>
                                                <p>
                                                    Genre : <b>{book?.genre}</b>
                                                </p>
                                                <p>
                                                    Tahun : <b>{book?.year}</b>
                                                </p>
                                            </div>
                                            <div className="flex items-end">
                                                {book?.status ==
                                                    "available" && (
                                                    <Badge
                                                        variant={"success"}
                                                        className="text-lg"
                                                    >
                                                        Tersedia
                                                    </Badge>
                                                )}
                                                {book?.status == "blank" && (
                                                    <Badge
                                                        variant={"destructive"}
                                                        className="text-lg"
                                                    >
                                                        Kosong
                                                    </Badge>
                                                )}
                                            </div>
                                        </TableCell>
                                        <TableCell className="border border-black">
                                            <span className="text-lg font-semibold">
                                                <b>{book?.location}</b>
                                            </span>
                                        </TableCell>
                                    </TableRow>
                                ))
                            )}
                        </TableBody>
                    </Table>
                    <div className="flex justify-end mt-3 absolute bottom-5 right-5">
                        <div className="flex items-center justify-end mt-2 gap-x-1.5">
                            <Button
                                size="icon"
                                disabled={currentPage == 1 || processing}
                                onClick={() => setCurrentPage(1)}
                            >
                                <ChevronsLeft />
                            </Button>
                            <Button
                                size="icon"
                                disabled={currentPage == 1 || processing}
                                onClick={() => setCurrentPage(currentPage - 1)}
                            >
                                <ChevronLeft />
                            </Button>
                            <strong className="mx-4 select-none text-sm font-medium">
                                {currentPage} / {data?.last_page}
                            </strong>
                            <Button
                                size="icon"
                                disabled={
                                    currentPage >= data?.last_page || processing
                                }
                                onClick={() => setCurrentPage(currentPage + 1)}
                            >
                                <ChevronRight />
                            </Button>
                            <Button
                                size="icon"
                                disabled={
                                    currentPage >= data?.last_page || processing
                                }
                                onClick={() => setCurrentPage(data?.last_page)}
                            >
                                <ChevronsRight />
                            </Button>
                        </div>
                    </div>
                </>
            )}
        </>
    );
}
